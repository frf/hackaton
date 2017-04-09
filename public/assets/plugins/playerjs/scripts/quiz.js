/*global jQuery:true, playerjs:true */

(function($, document){

    var dataJson = [
        {
            "Video" : "https://www.youtube.com/embed/9hIQjrMHTv4",
            "Questions": [
                {
                    "id"    : 1,
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 1,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "id"    : 2,
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 2,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "id"    : 3,
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 3,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "id"    : 4,
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 100,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "id"    : 5,
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 100,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "id"    : 6,
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 100,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "id"    : 7,
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 100,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                }
            ]
        }
    ];

    var bannerQuestion = function(i) {


        $.each(dataJson[0]['Questions'], function (index, item) {
            if (this.start = i){
                data = this;
            }
        });

        if ($('.email-collector.question').size() == 0) {

            $('#result').prepend([
                '<div class="email-collector question" style="text-align: left; font-size: 1vw;">',
                '<h1>' + data.title + '</h1>',
                '<form action="#" id="question_' + i + '">',
                '<div class="row name">',
                '<div class="col-sm-6">',
                '<label class="radio-inline col-sm-12">',
                '<input type="radio" name="answer_option" id="answer_option_a" checked="checked" value="a" > A ) ' + data.answer.a,
                '</label>',
                '</div>',
                '<div class="col-sm-6">',
                '<label class="radio-inline col-sm-12">',
                '<input type="radio" name="answer_option" id="answer_option_b" value="b"> B ) ' + data.answer.b,
                '</label>',
                '</div>',
                '</div>',
                '<div class="row name">',
                '<div class="col-sm-6">',
                '<label class="radio-inline col-sm-12">',
                '<input type="radio" name="answer_option" id="answer_option_c" value="c"> C ) ' + data.answer.c,
                '</label>',
                '</div>',
                '<div class="col-sm-6">',
                '<label class="radio-inline col-sm-12">',
                '<input type="radio" name="answer_option" id="answer_option_d" value="d"> D ) ' + data.answer.d,
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

        // In the beginning we can pass values into the row.

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
                '<input type="text" class="form-control" placeholder="Put your question here!" value="' + data.title + '">',
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
                '<input type="text" class="caption form-control" placeholder="Answer (A)" value="' + answers.a + '">',
                '</div>',
                '<div class="form-group col-sm-6">',
                '<label>B)</label>',
                '<input type="text" class="caption form-control" placeholder="Answer (B)" value="' + answers.b + '">',
                '</div>',
                '<div class="form-group col-sm-6">',
                '<label>C)</label>',
                '<input type="text" class="caption form-control" placeholder="Answer (C)" value="' + answers.c + '">',
                '</div>',
                '<div class="form-group col-sm-6">',
                '<label>D)</label>',
                '<input type="text" class="caption form-control" placeholder="Answer (D)" value="' + answers.d + '">',
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

    var player = null,
        captions = {};

    var timeupdate = function(data){
        var seconds = Math.floor(data.seconds);
        if (current_time != seconds && seconds > 0 ) {
            if (captions[seconds] !== undefined){
                    if (captions[seconds] == 0 ){
                        player.pause();
                        bannerQuestion(seconds);
                    }
            }
            current_time = seconds;
        }
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

        var questions = dataJson[0]["Questions"],
            url = dataJson[0]["Video"];

        //If we got a URL, then we need to build out the rows.
        $('#url').val(url);

        embed(url)
            .done(function(){
                // Go embed the URL
                $.each(questions, function(i, item) {
                    addQuestion(this,i);
                    $('#captions form input').trigger('blur');
                });

                // Autoplay
                player.on('ready', function(){
                    player.play();
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
                // checked="checked"
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


//            var emailRegister = function (email) {
//                $.getJSON( "http://localhost/rest/email/new?email="+email, function(data) {
//                    if (data[0].status == 'success'){
//                        $('fazalgo');
//                    };
//                });
//            }

            $(".email-collector.question").remove();
            player.play();
            return false;
        });

        // Add the rows to the captions dict.
        $(document).on('blur', '#captions form .questions', function(){
            var $parent = $(this);
            var time = $parent.find('.time').val();

            if (time){
                var p = time;
                // It's a range.
                if (p.length > 0){
                    if (captions[parseInt(time, 10)] == undefined){
                        captions[parseInt(time, 10)] = 0;
                    }
                }
            }
        });
    });
    $(".email-collector").hide();
})(jQuery, document);
