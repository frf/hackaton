/*global jQuery:true, playerjs:true */

(function($, document){

    var urlDataJson = "http://localhost/rest/"+id+"/courses/questions",
        questionsDB = [],
        currentTime = 0,
        captions = [];


    var getData = function () {
        $.getJSON(urlDataJson, function (data) {
            var questions = data['questions'];
            $.each(questions, function (i, item) {
                questionsDB[i]          = questions[i];
                captions[item.start]    = questions[i];
                addQuestion(questions[i], i);
            })
        });
    };

    var id = $("#id_video").val();
    var dataJson = getData();



    var bannerQuestion = function(data, i) {

        if ($('.email-collector.question').size() == 0) {

            $('#result').prepend([
                '<div class="email-collector question" style="text-align: left; font-size: 1vw;">',
                '<h1>' + data.title + '</h1>',
                '<form action="#" id="question_' + i + '">',
                '<div class="row name">',
                '<div class="col-sm-6">',
                '<label class="radio-inline col-sm-12">',
                '<input type="radio" class="answer_option" name="answer_option" id="answer_option_a" checked="checked" value="a" > A ) ' + data.answer.a,
                '</label>',
                '</div>',
                '<div class="col-sm-6">',
                '<label class="radio-inline col-sm-12">',
                '<input type="radio" class="answer_option" name="answer_option" id="answer_option_b" value="b"> B ) ' + data.answer.b,
                '</label>',
                '</div>',
                '</div>',
                '<div class="row name">',
                '<div class="col-sm-6">',
                '<label class="radio-inline col-sm-12">',
                '<input type="radio" class="answer_option" name="answer_option" id="answer_option_c" value="c"> C ) ' + data.answer.c,
                '</label>',
                '</div>',
                '<div class="col-sm-6">',
                '<label class="radio-inline col-sm-12">',
                '<input type="radio" class="answer_option" name="answer_option" id="answer_option_d" value="d"> D ) ' + data.answer.d,
                '</label>',
                '</div>',
                '</div>',
                '<div class="form-group">',
                '<input type="button" name="btnSaveQuestion" id="btnSaveQuestion" value="save" class="btn btn-md btn-block btn-primary saveQuestion text-uppercase">',
                '<input type="hidden" name="id" id="id" value="' + data.id + '" class="btn btn-md btn-block btn-primary text-uppercase">',
                '<input type="hidden" name="time" id="time" value="' + data.start + '" class="btn btn-md btn-block btn-primary text-uppercase">',
                '</form>',
                '</div>'
            ].join(''));
        };

    };
    var addQuestion = function(data,i){

        console.log(data);

        if (i == undefined){
            i = $('#captions form .questions').size() + 1;
        }

        i++;

        if (data === undefined){
            data = {
                "title": "",
                "start": 0,
                "answer": {
                    "a": "",
                    "b": "",
                    "c": "",
                    "d": ""
                }
            };
        }

        var answers = data.answer;

            $('#captions form').append([
                '<div class="row questions">',
                '<div class="form-group col-sm-11">',
                '<label>Question - ' + i + '</label>',
                '<input type="text" class="form-control questionTitle" placeholder="Put your question here!" value="' + data.title + '">',
                '</div>',
                '<div class="form-group col-sm-1">',
                '<label>Time</label>',
                '<input type="text" class="time form-control" placeholder="0" value="' + data.start + '">',
                '</div>',
                '<div class="form-group col-sm-12">',
                '<label>Answers</label>',
                '</div>',
                '<div class="answers">',
                '<div class="form-group col-sm-6">',
                '<label>A)</label>',
                '<input type="text" class="caption form-control caption_a" placeholder="Answer (A)" value="' + answers.a + '">',
                '</div>',
                '<div class="form-group col-sm-6">',
                '<label>B)</label>',
                '<input type="text" class="caption form-control caption_b" placeholder="Answer (B)" value="' + answers.b + '">',
                '</div>',
                '<div class="form-group col-sm-6">',
                '<label>C)</label>',
                '<input type="text" class="caption form-control caption_c" placeholder="Answer (C)" value="' + answers.c + '">',
                '</div>',
                '<div class="form-group col-sm-6">',
                '<label>D)</label>',
                '<input type="text" class="caption form-control caption_d" placeholder="Answer (D)" value="' + answers.d + '">',
                '<input type="hidden" name="id" id="id" value="' + data.id + '">',
                '</div>',
                '</div>',
                '<div class="form-group col-sm-12" style="text-align: right">',
                '<button type="submit" class="btn btn-danger btn-rounded remove">Remove</button>',
                '</div>',
                '<hr>',
                '</div>'
            ].join(''));
    };
    var current_time = 0;

    var player = null;

    var timeupdate = function(data){
        var seconds = Math.floor(data.seconds);

        $.each(questionsDB, function (i, item) {
            if (seconds != currentTime){
                if (currentTime > 0){
                    if (captions[seconds] != undefined){
                        player.pause();
                        bannerQuestion(captions[seconds]);
                    }
                }
                currentTime = seconds;
            }
        });

    };

    var embed = function(url){

        // Grab the data from Embedly's API.
        return $.embedly.oembed(url, {query: {scheme: 'http'}})
            .progress(function(obj){

                // Give up in an ugly way.
                if (!obj.html){
                    window.alert('This video could not be embedded');
                    return false;
                }

                // Figure out the ratio and build the div.
                var ratio = ((obj.height/obj.width)*100).toPrecision(4) + '%';
                var $div = $('<div class="resp"><span id="caption"></span></div>');
                $div.append(obj.html);
                //$div.css('padding-bottom', ratio);
                $('#result').append($div);

                // Find the iframe and create a players.
                player = new playerjs.Player($('iframe')[0]);
                player.on('ready', function(){

                    // Add a row for the first caption.
                    addQuestion();

                    // Make sure we have volume.
                    player.unmute();
                    player.on('timeupdate', timeupdate);
                });

                // Show the actions.
                $('.caption-actions').show();
                $('.caption-actions a.play').off('click').on('click', function(){
                    player.setCurrentTime(0);
                    player.play();
                });
            });
    };

    $(document).on('ready', function(){
        var initial = window.location.search.toString().substr(1).split('&').reduce(
            function(i,v){
                var p = v.split('=');
                if (p.length === 2) {
                    i[p[0]]=decodeURIComponent(p[1]);
                }
                return i;
            }, {});

        if (initial.url == undefined || initial.url == ""){
            initial.url = $('#url').val();
        }

        embed(initial.url)
            .done(function(){

                // Autoplay
                player.on('ready', function(){
                    //player.play();
                });
            });

        // Set up the remove row click.
        $(document).on('click', '.remove', function(){
            $(this).parents('.row').get(0).remove();
            return false;
        });

        function objectifyForm(formArray) {//serialize data function

            var returnArray = {};
            for (var i = 0; i < formArray.length; i++){
                if (formArray[i]['type'] == 'radio'){
                    if (formArray[i]['checked']){
                        returnArray[formArray[i]['name']] = formArray[i]['value'];
                    }
                } else {
                    returnArray[formArray[i]['name']] = formArray[i]['value'];
                }
            }
            return returnArray;
        }

        $(document).on('click', '.saveQuestion', function(event){
            var form = $(".email-collector.question form input");
            var formRes = objectifyForm(form);

            $.ajax({
                type: "GET",
                data: formRes,
                url: "http://localhost/rest/16/courses/saveQuestions",
                success: function(msg){
                    console.log(msg);
                }
            });


            $(".email-collector.question").remove();
            player.play();
            return false;
        });

        $("#btnClickSaveMail").click(function(){
            var emailCollector 	= $("#emailCollector").val();
            var nameCollector 	= $("#nameCollector").val();
            var lNameCollector 	= $("#lNameCollector").val();

            if(!isValidEmailAddress(emailCollector)){

                $("#msgErroEmail").html("Sorry! Must be a valid email.");

            } else {

                $("#msgErroEmail").html("");

                $.getJSON("/rest/email/new?email=" + emailCollector + "&name=" + nameCollector + "&lastname=" + lNameCollector, function (data) {

                    if (data[0].status == 'success') {
                        $("#msgErroEmail").html("");
                        $(".email-collector.form").hide();
                        player.play();
                    };

                    if (data[0].status == 'error') {
                        $("#msgErroEmail").html(data[0].message);
                    };
                });
            }
        });

//        var form = $(".email-collector.question form input");
//        var formRes = objectifyForm(form);


        // Add the rows to the captions dict.
        $(document).on('blur', '#captions form .questions', function(){
            $(".row.questions").each(function (i, item) {

                if (questionsDB[i] != undefined){
                    var title = $(item).find('.questionTitle').val(),
                        start = $(item).find('.time').val(),
                        a = $(item).find('.caption_a').val(),
                        b = $(item).find('.caption_b').val(),
                        c = $(item).find('.caption_c').val(),
                        d = $(item).find('.caption_d').val();

                        questionsDB[i].title  = title;
                        questionsDB[i].start  = start;
                        questionsDB[i].answer['a'] = a;
                        questionsDB[i].answer['b'] = b;
                        questionsDB[i].answer['c'] = c;
                        questionsDB[i].answer['d'] = d;
                }

            });
        });
    });
})(jQuery, document);
