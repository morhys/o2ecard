(function($) {
    'use strict';

    O2.eCards = {
        config: {
            jcrop_api : '',
            boundx : '',
            boundy : '',
            $preview : $('#preview-pane'),
            $pcnt : $('#preview-pane .preview-container'),
            $pimg : $('#preview-pane .preview-container img')
        },
        init: function(){

            $('#ecardOptions').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 145,
                itemMargin: 5,
                asNavFor: '#ecardSlider'
            });

            $('#ecardSlider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#ecardOptions"
            });

            $('#imgUpload').fileupload({
                url: O2.config.uploadUrl,
                dataType: 'json',
                done: function (e, data) {
                    if ( data.result && data.result.uploaded ) {
                        $('#uploaded').html($('<img src="' + O2.config.assetUrl + data.result.uploaded + '" alt="" id="userImg"/>'));
                        O2.eCards.crop( O2.config.assetUrl + data.result.uploaded );
                        O2.config.imgUploaded = data.result.uploaded;
                        $('.saveBtn').removeClass('visuallyhidden');
                    } else if ( data.result && data.result.errors ) {
                        $('#progress').html( data.result.errors.messages.imgUpload.join(' <br/>') );
                    } else {
                        $('#progress').text('Upload failed, please try again.');
                    }
                    O2.eCards.clearProgress();
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress').text( 'Uploading... ' + progress + '%' );
                    if ( progress == 100 )
                        O2.eCards.clearProgress();
                }
            });

            $( document ).on('submit', '.stepContainer', function(e) {
                O2.form.mode = this.className;
                $(this).attr('disabled', true);
                O2.form.validate(e);
            }).on( 'keyup', '[required]', function( e ) {
                if ( e.target.value.length > 1 ) {
                    O2.form.checkField(this);
                }
            }).on('click', '#mskUpload', function(e){
                e.preventDefault();
                $('#imgUpload').click();
            }).on('click', '.facebook_share', function( e ){
                e.preventDefault();
                O2.eCards.share( 'fb', {
                    link: $(this).parent().attr('addthis:url'),
                    img: O2.config.FB.img,
                    name: O2.config.FB.title,
                    caption: $(this).parent().attr('addthis:title'),
                    callback: function(){}
                });
            });
        },
        crop: function( file ) {
            O2.eCards.config.$pcnt.removeClass('hide');
            O2.eCards.config.$pimg.attr('src', file);

            O2.eCards.config.xsize = O2.eCards.config.$pcnt.width();
            O2.eCards.config.ysize = O2.eCards.config.$pcnt.height();

            $('#userImg', '#uploaded').Jcrop({
                onChange: O2.eCards.updatePreview,
                onSelect: O2.eCards.updatePreview,
                aspectRatio: O2.eCards.config.xsize / O2.eCards.config.ysize
            },function(){
                // Use the API to get the real image size
                var bounds = this.getBounds();
                O2.eCards.config.boundx = bounds[0];
                O2.eCards.config.boundy = bounds[1];
                // Store the API in the jcrop_api variable
                O2.eCards.config.jcrop_api = this;

                // Move the preview into the jcrop container for css positioning
                //O2.eCards.config.$preview.appendTo( O2.eCards.config.jcrop_api.ui.holder );
            });
        },
        updatePreview: function(c) {
            if (parseInt(c.w) > 0) {
                var rx = O2.eCards.config.xsize / c.w,
                    ry = O2.eCards.config.ysize / c.h;

                O2.eCards.config.$pimg.css({
                    width: Math.round( rx * O2.eCards.config.boundx ) + 'px',
                    height: Math.round( ry * O2.eCards.config.boundy ) + 'px',
                    marginLeft: '-' + Math.round( rx * c.x ) + 'px',
                    marginTop: '-' + Math.round( ry * c.y ) + 'px'
                });

                O2.eCards.config.params = { 
                    'x' : Math.round( rx * c.x ), 'y' : Math.round( ry * c.y ),
                    'w' : Math.round( rx * O2.eCards.config.boundx ), 'h' : Math.round( ry * O2.eCards.config.boundy )
                };
            }
        },
        save: function( callback ) {
            if ( !O2.config.imgUploaded && O2.config.usereCard ) {
                $('.usereCard', '#step-3').attr( 'src', O2.config.assetUrl + O2.config.usereCard.img );
                if (callback && typeof(callback) === "function")
                    callback();
            }

            if ( !O2.eCards.config.selectedCard )
                return false;

            $.post(O2.config.baseUrl + '/ecard/save', {
                'ecard' : {
                    'src' : O2.eCards.config.selectedCard.data('ecard'),
                    'left': O2.eCards.config.selectedCard.data('placeholderX'),
                    'top': O2.eCards.config.selectedCard.data('placeholderY'),
                    'width': O2.eCards.config.selectedCard.data('placeholderWidth'),
                    'height': O2.eCards.config.selectedCard.data('placeholderHeight'),
                    'img': O2.config.imgUploaded
                },
                'params' : O2.eCards.config.params
            }, function(data) {
                if ( data ) {
                    O2.config.usereCard = data;
                    $('.usereCard', '#step-3').attr( 'src', O2.config.assetUrl + O2.config.usereCard.img );
                    $('[name="usereCard[img]"]', '#step-3').val(O2.config.usereCard.img);
                    $('[name="usereCard[slug]"]', '#step-3').val(O2.config.usereCard.slug);
                    $('[name="usereCard[thumb]"]', '#step-3').val(O2.config.usereCard.thumb);
                    $('[name="usereCard[url]"]', '#step-3').val(O2.config.usereCard.url);
                    if (callback && typeof(callback) === "function")
                        callback();
                }
            }, 'json');
        },
        clearProgress: function() {
            setTimeout(function(){
                $('#progress').animate({ opacity: 0 }, 800, function() {
                    $(this).html('').css({opacity:1});
                });
            }, 2000);
        },
        share: function ( w, data ) {
            if ( w == 'fb' && typeof FB !== 'undefined' ) {
                FB.ui({
                    method: 'feed',
                    link: data.link,
                    picture: data.img,
                    name: data.name,
                    caption: data.caption
                }, data.callback);
            }
        }
    };

    O2.form = {
        valid: 0,
        validate: function(form) {
            var fields = $(form.currentTarget).find('[required]');
            O2.form.valid = 0;

            fields.each(function() {
                O2.form.checkField(this);
            });

            if (O2.form.valid > 0) {
                form.preventDefault();
                $(form.currentTarget).attr('disabled', false);
            } else {
                $(form.currentTarget).attr('disabled', false);
                return true;
            }
        },
        checkField: function(el) {
            var ck_email = /^[A-Z0-9._%+\-]+@[A-Z0-9.\-]+\.[A-Z]{2,4}$/i,
                ck_number = /^[0-9 ]{11,13}$/,
                ck_date = /^[A-Za-z]+$/,
                ck_file = /\.(gif|jpg|jpeg|tiff|png|bmp|doc|docx|pdf)$/i,
                yt_id = $(el).attr('id') === "youtube_link" ? O2.form.ytVidId(el.value) : '';

            $(el).parent().removeClass('error');
            $(el).parent().next('.err').remove();

            if (($(el).attr('type') == "file" && !ck_file.test(el.value)) || ($(el).attr('type') == "date" && !ck_date.test(el.value)) || ($(el).attr('type') == "email" && !ck_email.test(el.value)) || ($(el).attr('type') == "tel" && !ck_number.test(el.value)) || ($(el).attr('type') == "checkbox" && $(el).is(':checked') != true) || ($(el).attr('type') != "checkbox" && $.trim(el.value) == "")) {
                $(el).parent().addClass('error');
                //.val($(el).attr('type') == "checkbox" ? 'on' : null)
                O2.form.valid++;
                return false;
            }
        }
    };

    O2.router = new Simrou({
        '/step-:id' : function ( e, p ) {
            p['id'] = p['id'] ? p['id'] : O2.config.firstStep;

            switch ( p['id'] ) {
                case '2':
                    var ecardUrl = O2.config.selectedCard ? O2.config.selectedCard : $('#ecardSlider .flex-active-slide img').attr('src');
                    O2.eCards.config.selectedCard = $('#ecardSlider .flex-active-slide img[src="' + ecardUrl + '"]');

                    if ( !ecardUrl || !O2.eCards.config.selectedCard.length ) {
                        O2.router.navigate('/step-1');
                        alert('Please select a card.');
                    } else {
                        $('.usereCard', '#step-2').attr('src', O2.eCards.config.selectedCard.attr('src') );
                        $('#preview-pane', '#step-2').css({
                            'left': O2.eCards.config.selectedCard.data('placeholderX'),
                            'top': O2.eCards.config.selectedCard.data('placeholderY')
                        });
                        $('.preview-container', '#step-2').css({
                            'width': O2.eCards.config.selectedCard.data('placeholderWidth'),
                            'height': O2.eCards.config.selectedCard.data('placeholderHeight')
                        });

                        if ( O2.config.imgUploaded )
                            O2.eCards.crop();
                    }
                    break;
                case '3':
                    if ( !O2.config.usereCard || O2.config.usereCard.error ) {
                        alert( O2.config.usereCard.error ? O2.config.usereCard.error : 'Please upload an image and click next.');
                        O2.router.navigate('/step-2');
                        return false;
                    }
                    break;
            }

            $('.step, #stepsNav li').removeClass('active');
            $('#step' + p['id'] + ', #stepsNav li:has(a[href="#/step-' + p['id'] + '"])').addClass('active');

            $('.stepContainer').stop().animate({
                left: '-'+ ( p['id'] - 1 ) * 100 + '%'
            }, 500, 'swing');

        }, 
        '/save' : function() {
            if ( !O2.eCards.config.selectedCard )
                O2.router.navigate('/step-1');

            O2.eCards.save(function(){
                O2.router.navigate('/step-3');
            });
        }
    });

    O2.init = function() {
        $('.step, #stepsNav li:first').addClass('active');
        O2.eCards.init();
        O2.router.start();
    };

  $(function() {
    O2.init();
  });
}(window.jQuery));
