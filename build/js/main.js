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
                    $.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo('#uploaded');
                    });
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .bar').css( 'width', progress + '%' );
                }
            });
        },
        crop: function() {
            O2.eCards.config.xsize = O2.eCards.config.$pcnt.width();
            O2.eCards.config.ysize = O2.eCards.config.$pcnt.height();

            $('#userImg').Jcrop({
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
                        O2.eCards.crop();
                    }
                    break;
                case '3':

                    break;
            }

            $('.step, #stepsNav li').removeClass('active');
            $('#step' + p['id'] + ', #stepsNav li:has(a[href="#/step-' + p['id'] + '"])').addClass('active');

            $('.stepContainer').stop().animate({
                left: '-'+ ( p['id'] - 1 ) * 100 + '%'
            }, 500, 'swing');

        }, 
        '/*href' : function( e, p )  {
            var q = '#' + p['href'].replace('/','_'),
                c = '.' + p['href'].replace('/','_');

            if ( $( q + 'Modal').length ) {
                $( q + 'Modal, .modal.in').modal('toggle');
                if ( SOTY.config.next && SOTY.config.next !== '' ) {
                    $( q + 'Modal .modal-footer a[href="' + SOTY.config.next + '"]').remove();
                    $( q + 'Modal .modal-footer').append('<a href="' + SOTY.config.next + '" class="btn white">Back</a>');
                }
            } else if ( $( '.section' + c ).length ) {
                SOTY.app.scrollTo( '.section' + c );
                $( '.section' + c + ' [data-toggle]' ).click();
            } else if ( $( q ).length ) {
                SOTY.app.scrollTo( q );
                SOTY.nav.navigate('/');
            } 
        }
    });

    O2.init = function() {
        O2.eCards.init();
        O2.router.start();
    };

  $(function() {
    O2.init();
  });
}(window.jQuery));
