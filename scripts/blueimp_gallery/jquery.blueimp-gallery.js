/*
 * blueimp Gallery jQuery plugin 1.2.2
 * https://github.com/blueimp/Gallery
 *
 * Copyright 2013, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global define, window, document */
var visible = false;
(function (factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define([
            'jquery',
            './blueimp-gallery'
        ], factory);
    } else {
        factory(
            window.jQuery,
            window.blueimp.Gallery
        );
    }
}(function ($, Gallery) {
    'use strict';

    // Global click handler to open links with data-gallery attribute
    // in the Gallery lightbox:
    $(document).on('click', '[data-gallery]', function (event) {
        // Get the container id from the data-gallery attribute:
        var id = $(this).data('gallery'),
            widget = $(id),
            container = (widget.length && widget) ||
                $(Gallery.prototype.options.container),
            callbacks = {
                onopen: function () {
                    container
                        .data('gallery', this)
                        .trigger('open');
                },
                onopened: function () {
                    //hindrer høyreklikk
                    $(container).bind("contextmenu", function(event){
                        event.preventDefault();
                        if (!visible) {
                            visible = true;
                            $("<div class='custom-menu'>These photos are copyrighted by Hilde Morris. All rights reserved. Unauthorized use prohibited.</div>")
                            .appendTo("body").css({top: event.pageY + "px", left: event.pageX + "px"});
                        }
                    });
                    $(document).bind("click", function(event) {
                        if (visible) {
                            visible = false;
                            $("div.custom-menu").hide();
                        }
                    });
                    container.trigger('opened');
                },
                onslide: function (index, slide) {
                    //setter subtittel manuelt
                    var text = this.list[index].getAttribute('data-description'),
                    node = container.find('.modal-description');
                    node.empty();
                    
                    if (text) {
                        node[index].appendChild(document.createTextNode(text));
                    }
                    container.trigger('slide', arguments);
                },
                onslideend: function () {
                    container.trigger('slideend', arguments);
                },
                onslidecomplete: function () {
                    container.trigger('slidecomplete', arguments);
                },
                onclose: function () {
                    container.trigger('close');
                },
                onclosed: function () {
                    container
                        .trigger('closed')
                        .removeData('gallery');
                }
            },
            options = $.extend(
                // Retrieve custom options from data-attributes
                // on the Gallery widget:
                container.data(),
                {
                    container: container[0],
                    index: this,
                    event: event
                },
                callbacks
            ),
            // Select all links with the same data-gallery attribute:
            links = $('[data-gallery="' + id + '"]');
        if (options.filter) {
            links = links.filter(options.filter);
        }
        return new Gallery(links, options);
    });
}));
