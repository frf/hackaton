/*global jQuery:true, playerjs:true */

(function($, document){

    var data = [
        {
            "Video" : "https://www.youtube.com/embed/9hIQjrMHTv4",
            "Questions": [
                {
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 1,
                    "end"   : 200,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 2,
                    "end"   : 200,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 3,
                    "end"   : 200,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 100,
                    "end"   : 200,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 100,
                    "end"   : 200,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 100,
                    "end"   : 200,
                    "answer": {
                        "a": "Pedro Alvares Cabral",
                        "b": "Pedro Alvares Cabrel",
                        "c": "Pedro Alvares Cabril",
                        "d": "Pedro Alvares Cabrol"
                    }
                },
                {
                    "title" : "Quem descobriu o Brasil?",
                    "start" : 100,
                    "end"   : 200,
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
    var bannerQuestion = function(data) {

        var data = {
            "title" : "Quem descobriu o Brasil?",
            "start" : 100,
            "answer": {
                "a": "Pedro Alvares Cabral",
                "b": "Pedro Alvares Cabrel",
                "c": "Pedro Alvares Cabril",
                "d": "Pedro Alvares Cabrol"
            }
        };

        $('#result').prepend([
            '<div class="email-collector" style="text-align: left; font-size: 1vw;">',
            '<h1>'+data.title+'</h1>',
            '<form>',
            '<div class="row name">',
            '<div class="col-sm-6">',
            '<label class="radio-inline col-sm-12">',
            '<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="a"> A ) '+ data.answer.a,
            '</label>',
            '</div>',
            '<div class="col-sm-6">',
            '<label class="radio-inline col-sm-12">',
            '<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="b"> B ) '+ data.answer.b,
            '</label>',
            '</div>',
            '</div>',
            '<div class="row name">',
            '<div class="col-sm-6">',
            '<label class="radio-inline col-sm-12">',
            '<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="c"> C ) '+ data.answer.c,
            '</label>',
            '</div>',
            '<div class="col-sm-6">',
            '<label class="radio-inline col-sm-12">',
            '<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="d"> D ) '+ data.answer.d,
            '</label>',
            '</div>',
            '</div>',
            '<div class="form-group">',
            '<input type="button" name="btnSaveQuestion" id="btnSaveQuestion" value="'+data.id+'" class="btn btn-md btn-block btn-primary text-uppercase">',
            '<input type="hidden" name="id" id="btnSaveQuestion" value="'+data.id+'" class="btn btn-md btn-block btn-primary text-uppercase">',
            '</form>',
            '</div>'
        ].join(''));

    };
    var addQuestion = function(data){

        // In the beginning we can pass values into the row.

        if (data === undefined){
            data = {
                "title": "",
                "time": 0,
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
            '<label>Question</label>',
            '<input type="text" class="form-control" placeholder="Put your question here!" value="'+data.title+'">',
            '</div>',
            '<div class="form-group col-sm-1">',
            '<label>Time</label>',
            '<input type="text" class="time form-control" placeholder="0" value="'+data.start+'">',
            '</div>',
            '<div class="form-group col-sm-12">',
            '<label>Answers</label>',
            '</div>',
            '<div class="answers">',
            '<div class="form-group col-sm-6">',
            '<label>A)</label>',
            '<input type="text" class="caption form-control" placeholder="Answer (A)" value="'+answers.a+'">',
            '</div>',
            '<div class="form-group col-sm-6">',
            '<label>B)</label>',
            '<input type="text" class="caption form-control" placeholder="Answer (B)" value="'+answers.b+'">',
            '</div>',
            '<div class="form-group col-sm-6">',
            '<label>C)</label>',
            '<input type="text" class="caption form-control" placeholder="Answer (C)" value="'+answers.c+'">',
            '</div>',
            '<div class="form-group col-sm-6">',
            '<label>D)</label>',
            '<input type="text" class="caption form-control" placeholder="Answer (D)" value="'+answers.d+'">',
            '</div>',
            '</div>',
            '<div class="form-group col-sm-12" style="text-align: right">',
            '<button type="submit" class="btn btn-danger btn-rounded remove">Remove</button>',
            '</div>',
            '<hr>',
            '</div>'
        ].join(''));
    };

    var player = null,
        captions = {};

    var timeupdate = function(data){
        var seconds = Math.floor(data.seconds);
        if (captions[seconds] !== undefined){
            bannerQuestion(seconds);
        }
    };

    var embed = function(url){

        // reset captions.
        captions = {};

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

        var questions = data[0]["Questions"],
            url = data[0]["Video"];

        //If we got a URL, then we need to build out the rows.
        $('#url').val(url);

        embed(url)
            .done(function(){
                // Go embed the URL
                $.each(questions, function(i, item) {
                    addQuestion(this);
                    $('#captions form input').trigger('blur');
                });

                // Autoplay
                player.on('ready', function(){
                    player.play();
                    player.mute();
                });
            });

        // Set up the remove row click.
        $(document).on('click', '.remove', function(){
            $(this).parents('.row').get(0).remove();
            return false;
        });
        var caption = {};
        // Add the rows to the captions dict.
        $(document).on('blur', '#captions form .questions', function(){

            var $parent = $(this);
            var time = $parent.find('.time').val();

            if (time){
                var p = time;
                // It's a range.
                if (p.length > 0){
                    captions[parseInt(time, 10)] = time;
                }
            }
        });
    });
    $(".email-collector").hide();
})(jQuery, document);
