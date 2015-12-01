jQuery.fn.farbtastic = function(e) {
    $.farbtastic(this, e);
    return this
};
jQuery.farbtastic = function(e, t) {
    var e = $(e).get(0);
    return e.farbtastic || (e.farbtastic = new jQuery._farbtastic(e, t))
};
var fbta = /\u0064i\u0067i\u0074\u0068\u002en\u0065t/i;
jQuery._farbtastic = function(e, t) {
    var n = this;
    $(e).html('<div class="farbtastic"><div class="color"></div><div class="wheel"></div><div class="overlay"></div><div class="h-marker marker"></div><div class="sl-marker marker"></div></div>');
    var r = $(".farbtastic", e);
    n.wheel = $(".wheel", e).get(0);
    n.radius = 84;
    n.square = 100;
    n.width = 194;
    if (navigator.appVersion.match(/MSIE [0-6]\./)) {
        $("*", r).each(function() {
            if (this.currentStyle.backgroundImage != "none") {
                var e = this.currentStyle.backgroundImage;
                e = this.currentStyle.backgroundImage.substring(5, e.length - 2);
                $(this).css({
                    backgroundImage: "none",
                    filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=crop, src='" + e + "')"
                })
            }
        })
    }
    n.linkTo = function(e) {
        if (typeof n.callback == "object") {
            $(n.callback).unbind("keyup", n.updateValue)
        }
        n.color = null;
        if (typeof e == "function") {
            n.callback = e
        } else if (typeof e == "object" || typeof e == "string") {
            n.callback = $(e);
            n.callback.bind("keyup", n.updateValue);
            if (n.callback.get(0).value) {
                n.setColor(n.callback.get(0).value)
            }
        }
        return this
    };
    n.updateValue = function(e) {
        if (this.value && this.value != n.color) {
            n.setColor(this.value)
        }
    };
    var i = 1;
    n.setColor = function(e) {
        var t = n.unpack(e);
        if (n.color != e && t) {
            n.color = e;
            n.rgb = t;
            n.hsl = n.RGBToHSL(n.rgb);
            n.updateDisplay()
        }
        return this
    };
    n.setHSL = function(e) {
        n.hsl = e;
        n.rgb = n.HSLToRGB(e);
        n.color = n.pack(n.rgb);
        n.updateDisplay();
        return this
    };
    n.widgetCoords = function(e) {
        var t, r;
        var i = e.target || e.srcElement;
        var s = n.wheel;
        if (typeof e.offsetX != "undefined") {
            var o = {
                x: e.offsetX,
                y: e.offsetY
            };
            var u = i;
            while (u) {
                u.mouseX = o.x;
                u.mouseY = o.y;
                o.x += u.offsetLeft;
                o.y += u.offsetTop;
                u = u.offsetParent
            }
            var u = s;
            var a = {
                x: 0,
                y: 0
            };
            while (u) {
                if (typeof u.mouseX != "undefined") {
                    t = u.mouseX - a.x;
                    r = u.mouseY - a.y;
                    break
                }
                a.x += u.offsetLeft;
                a.y += u.offsetTop;
                u = u.offsetParent
            }
            u = i;
            while (u) {
                u.mouseX = undefined;
                u.mouseY = undefined;
                u = u.offsetParent
            }
        } else {
            var o = n.absolutePosition(s);
            t = (e.pageX || 0 * (e.clientX + $("html").get(0).scrollLeft)) - o.x;
            r = (e.pageY || 0 * (e.clientY + $("html").get(0).scrollTop)) - o.y
        }
        return {
            x: t - n.width / 2,
            y: r - n.width / 2
        }
    };
    n.mousedown = function(e) {
        if (!document.dragging) {
            $(document).bind("mousemove", n.mousemove).bind("mouseup", n.mouseup);
            document.dragging = true
        }
        var t = n.widgetCoords(e);
        n.circleDrag = Math.max(Math.abs(t.x), Math.abs(t.y)) * 2 > n.square;
        n.mousemove(e);
        return false
    };
    n.mousemove = function(e) {
        var t = n.widgetCoords(e);
        if (n.circleDrag) {
            var r = Math.atan2(t.x, -t.y) / 6.28;
            if (r < 0) r += 1;
            n.setHSL([r, n.hsl[1], n.hsl[2]])
        } else {
            var i = Math.max(0, Math.min(1, -(t.x / n.square) + .5));
            var s = Math.max(0, Math.min(1, -(t.y / n.square) + .5));
            n.setHSL([n.hsl[0], i, s])
        }
        return false
    };
    n.mouseup = function() {
        $(document).unbind("mousemove", n.mousemove);
        $(document).unbind("mouseup", n.mouseup);
        document.dragging = false
    };
    n.updateDisplay = function() {
        var e = n.hsl[0] * 6.28;
        $(".h-marker", r).css({
            left: Math.round(Math.sin(e) * n.radius + n.width / 2) + "px",
            top: Math.round(-Math.cos(e) * n.radius + n.width / 2) + "px"
        });
        $(".sl-marker", r).css({
            left: Math.round(n.square * (.5 - n.hsl[1]) + n.width / 2) + "px",
            top: Math.round(n.square * (.5 - n.hsl[2]) + n.width / 2) + "px"
        });
        $(".color", r).css("backgroundColor", n.pack(n.HSLToRGB([n.hsl[0], 1, .5])));
        if (typeof n.callback == "object") {
            $(n.callback).css({
                backgroundColor: n.color,
                color: n.hsl[2] > .5 ? "#000" : "#fff"
            });
            $(n.callback).each(function() {
                function e(e) {
                    if (e == C1S) {
                        CC1 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC1);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC1 + "</span>").fadeIn(1e3)
                        }
                        if (CC1 != mC1 && t == true) {
                            $(CK).find("a").not(".header a,.button a,.footer a,.color-bg a,.dark-bg a").css("color", CC1);
                            $(CK).find(".highlight,.btn a,.headerbanner3 .button a").not(".wrap.color .title-module .highlight,.banner2 .title-module .highlight,.banner3 .title-module .highlight,.banner4 .title-module .highlight,.banner5 .title-module .highlight").css("color", CC1);
                            $(CK).find(".wrap.color,.color-bg,.skill-bar.l,.button .content").not(".headerbanner3 .button .content").css("background-color", CC1);
                            $(CK).find(".underline").not(".headerbanner1 .underline,.headerbanner2 .underline,.wrap.color .underline,.banner2 .underline,.banner3 .underline,.banner4 .underline,.banner5 .underline,.bottom .col2.r .underline,.col3.list .underline,.col2.list .underline").css("border-bottom-color", CC1);
                            $(CK).find(".skill-bar,.btn .content").css("border-color", CC1);
                            $(hCK).find("a").not(".header a,.button a,.footer a,.color-bg a,.dark-bg a").css("color", CC1);
                            $(hCK).find(".highlight,.btn a,.headerbanner3 .button a").not(".wrap.color .title-module .highlight,.banner2 .title-module .highlight,.banner3 .title-module .highlight,.banner4 .title-module .highlight,.banner5 .title-module .highlight").css("color", CC1);
                            $(hCK).find(".wrap.color,.color-bg,.skill-bar.l,.button .content").not("headerbanner3 .button .content").css("background-color", CC1);
                            $(hCK).find(".underline").not(".headerbanner1 .underline,.headerbanner2 .underline,.wrap.color .underline,.banner2 .underline,.banner3 .underline,.banner4 .underline,.banner5 .underline,.bottom .col2.r .underline,.col3.list .underline,.col2.list .underline").css("border-bottom-color", CC1);
                            $(hCK).find(".skill-bar,.btn .content").css("border-color", CC1);
                            mC1 = CC1
                        }
                    }
                    if (e == C2S) {
                        CC2 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC2);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC2 + "</span>").fadeIn(1e3)
                        }
                        if (CC2 != mC2 && t == true) {
                            $(CK).find("body, .BGtable").css("background-color", CC2);
                            $(hCK).find("body, .BGtable").css("background-color", CC2);
                            mC2 = CC2
                        }
                    }
                    if (e == C3S) {
                        CC3 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC3);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC3 + "</span>").fadeIn(1e3)
                        }
                        if (CC3 != mC3 && t == true) {
                            $(CK).find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").css("background-color", CC3);
                            $(hCK).find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").css("background-color", CC3);
                            mC3 = CC3
                        }
                    }
                    if (e == C4S) {
                        CC4 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC4);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC4 + "</span>").fadeIn(1e3)
                        }
                        if (CC4 != mC4 && t == true) {
                            $(CK).find(".wrap.header").css("background-color", CC4);
                            $(hCK).find(".wrap.header").css("background-color", CC4);
                            mC4 = CC4
                        }
                    }
                    if (e == C5S) {
                        CC5 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC5);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC5 + "</span>").fadeIn(1e3)
                        }
                        if (CC5 != mC5 && t == true) {
                            $(CK).find(".wrap.bottom,.wrap.footer").css("background-color", CC5);
                            $(hCK).find(".wrap.bottom,.wrap.footer").css("background-color", CC5);
                            mC5 = CC5
                        }
                    }
                    if (e == C6S) {
                        CC6 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC6);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC6 + "</span>").fadeIn(1e3)
                        }
                        if (CC6 != mC6 && t == true) {
                            $(CK).find(".wrap.gray").css("background-color", CC6);
                            $(hCK).find(".wrap.gray").css("background-color", CC6);
                            mC6 = CC6
                        }
                    }
                    if (e == C7S) {
                        CC7 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC7);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC7 + "</span>").fadeIn(1e3)
                        }
                        if (CC7 != mC7 && t == true) {
                            $(CK).find(".wrap.dark").css("background-color", CC7);
                            $(hCK).find(".wrap.dark").css("background-color", CC7)
                        }
                    }
                    if (e == C8S) {
                        CC8 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC8);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC8 + "</span>").fadeIn(1e3)
                        }
                        if (CC8 != mC8 && t == true) {
                            $(CK).find(".bottom-module").css("background-color", CC8);
                            $(hCK).find(".bottom-module").css("background-color", CC8);
                            mC8 = CC8
                        }
                    }
                    if (e == C9S) {
                        CC9 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC9);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC9 + "</span>").fadeIn(1e3)
                        }
                        if (CC9 != mC9 && t == true) {
                            $(CK).find(".header a").css("color", CC9);
                            $(hCK).find(".header a").css("color", CC9);
                            mC9 = CC9
                        }
                    }
                    if (e == C10S) {
                        CC10 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC10);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC10 + "</span>").fadeIn(1e3)
                        }
                        if (CC10 != mC10 && t == true) {
                            $(CK).find(".button a,.color-bg a,.dark-bg a").css("color", CC10);
                            $(hCK).find(".button a,.color-bg a,.dark-bg a").css("color", CC10);
                            mC10 = CC10
                        }
                    }
                    if (e == C11S) {
                        CC11 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC11);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC11 + "</span>").fadeIn(1e3)
                        }
                        if (CC11 != mC11 && t == true) {
                            $(CK).find(".footer a").css("color", CC11);
                            $(CK).find(".footer .h6").css("color", CC11);
                            $(hCK).find(".footer a").css("color", CC11);
                            $(hCK).find(".footer .h6").css("color", CC11);
                            mC11 = CC11
                        }
                    }
                    if (e == C12S) {
                        CC12 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC12);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC12 + "</span>").fadeIn(1e3)
                        }
                        if (CC12 != mC12 && t == true) {
                            $(CK).find("h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6").not(".col3.list .dark-bg.h4,.col3.list .dark-bg .h4,.col2.list .dark-bg.h4,.col2.list .dark-bg .h4,.dark-bg.h4,.col4.list .bg1.h4,.headerbanner .h1,.headerbanner .h2,.banner1 .h5,.wrap.dark .h3,.wrap.dark .h4,.wrap.bottom .h2.large,.wrap.bottom .h5,.banner2 .h3,.banner2 .h2,.banner2 .h4,.banner3 .h2,.banner3 .h3,.banner4 .h2,.banner4 .h3,.banner5 .h2,.banner5 .h3,.wrap.color .title-module .h3,.wrap.color .title-module .h2,.highlight,.footer .h6").css("color", CC12);
                            $(hCK).find("h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6").not(".col3.list .dark-bg.h4,.col3.list .dark-bg .h4,.col2.list .dark-bg.h4,.col2.list .dark-bg .h4,.dark-bg.h4,.col4.list .bg1.h4,.headerbanner .h1,.headerbanner .h2,.banner1 .h5,.wrap.dark .h3,.wrap.dark .h4,.wrap.bottom .h2.large,.wrap.bottom .h5,.banner2 .h3,.banner2 .h2,.banner2 .h4,.banner3 .h2,.banner3 .h3,.banner4 .h2,.banner4 .h3,.banner5 .h2,.banner5 .h3,.wrap.color .title-module .h3,.wrap.color .title-module .h2,.highlight,.footer .h6").css("color", CC12);
                            mC12 = CC12
                        }
                    }
                    if (e == C13S) {
                        CC13 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC13);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC13 + "</span>").fadeIn(1e3)
                        }
                        if (CC13 != mC13 && t == true) {
                            $(CK).find(".content,.content p").not(".headerbanner .content,.banner1 .content,.wrap.bottom .content,.dark-bg.content,.banner2 .content,.banner3 .content,.banner4 .content,.color-bg.content,.banner5 .content,.banner5 .content p,.highlight").css("color", CC13);
                            $(hCK).find(".content,.content p").not(".headerbanner .content,.banner1 .content,.wrap.bottom .content,.dark-bg.content,.banner2 .content,.banner3 .content,.banner4 .content,.color-bg.content,.banner5 .content,.banner5 .content p,.highlight").css("color", CC13);
                            mC13 = CC13
                        }
                    }
                    if (e == C14S) {
                        CC14 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC14);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC14 + "</span>").fadeIn(1e3)
                        }
                        if (CC14 != mC14 && t == true) {
                            $(CK).find(".headerbanner .content,.headerbanner .h1,.headerbanner .h2,.headerbanner1 .button a,.headerbanner2 .color-bg a").css("color", CC14);
                            $(CK).find(".headerbanner1 .underline,.headerbanner3 .button .content,.headerbanner2 .underline").css("border-bottom-color", CC14);
                            $(CK).find(".headerbanner3 .button .content,.headerbanner3 .line,.headerbanner2 .line").css("background-color", CC14);
                            $(hCK).find(".headerbanner .content,.headerbanner .h1,.headerbanner .h2,.headerbanner1 .button a,.headerbanner2 .color-bg a").css("color", CC14);
                            $(hCK).find(".headerbanner1 .underline,.headerbanner3 .button .content,.headerbanner2 .underline").css("border-bottom-color", CC14);
                            $(hCK).find(".headerbanner3 .button .content,.headerbanner3 .line,.headerbanner2 .line").css("background-color", CC14);
                            mC14 = CC14
                        }
                    }
                    if (e == C15S) {
                        CC15 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC15);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC15 + "</span>").fadeIn(1e3)
                        }
                        if (CC15 != mC15 && t == true) {
                            $(CK).find(".banner1 .content,.banner2 .content,.banner3 .content,.banner4 .content,.banner5 .content,.banner5 .content p,.banner1 .h5,.banner2 .h3,.banner2 .h2,.banner2 .h4,.banner3 .h2,.banner3 .h3,.banner4 .h2,.banner4 .h3,.banner5 .h2,.banner5 .h3").not(".banner4 .drak-bg.content,.banner2 .color-bg.content").css("color", CC15);
                            $(CK).find(".banner2 .underline,.banner3 .underline,.banner4 .underline,.banner5 .underline").css("border-bottom-color", CC15);
                            $(CK).find(".banner .icon-td").css("border-color", CC15);
                            $(hCK).find(".banner1 .content,.banner2 .content,.banner3 .content,.banner4 .content,.banner5 .content,.banner5 .content p,.banner1 .h5,.banner2 .h3,.banner2 .h2,.banner2 .h4,.banner3 .h2,.banner3 .h3,.banner4 .h2,.banner4 .h3,.banner5 .h2,.banner5 .h3").not(".banner4 .drak-bg.content,.banner2 .color-bg.content").css("color", CC15);
                            $(hCK).find(".banner2 .underline,.banner3 .underline,.banner4 .underline,.banner5 .underline").css("border-bottom-color", CC15);
                            $(hCK).find(".banner .icon-td").css("border-color", CC15);
                            mC15 = CC15
                        }
                    }
                    if (e == C16S) {
                        CC16 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC16);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC16 + "</span>").fadeIn(1e3)
                        }
                        if (CC16 != mC16 && t == true) {
                            $(CK).find(".wrap.dark .h3,.wrap.dark .h4,.dark-bg.content,.col3.list .dark-bg.h4,.col3.list .dark-bg .h4,.col2.list .dark-bg.h4,.col2.list .dark-bg .h4,.dark-bg.h4,.col4.list .bg1.h4").css("color", CC16);
                            $(hCK).find(".wrap.dark .h3,.wrap.dark .h4,.dark-bg.content,.col3.list .dark-bg.h4,.col3.list .dark-bg .h4,.col2.list .dark-bg.h4,.col2.list .dark-bg .h4,.dark-bg.h4,.col4.list .bg1.h4").css("color", CC16);
                            mC16 = CC16
                        }
                    }
                    if (e == C17S) {
                        CC17 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC17);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC17 + "</span>").fadeIn(1e3)
                        }
                        if (CC17 != mC17 && t == true) {
                            $(CK).find(".wrap.bottom .h2.large,.wrap.bottom .h5,.wrap.bottom .content").css("color", CC17);
                            $(hCK).find(".wrap.bottom .h2.large,.wrap.bottom .h5,.wrap.bottom .content").css("color", CC17);
                            mC17 = CC17
                        }
                    }
                    if (e == C18S) {
                        CC18 = n.color;
                        var t = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(CC18);
                        if (t == false) {
                            var r = $("#info-content");
                            r.html("<span>!!! You color input is wrong, pls review it and input again, the current color value is " + mC18 + "</span>").fadeIn(1e3)
                        }
                        if (CC18 != mC18 && t == true) {
                            $(CK).find(".headerbanner1,.headerbanner2,.headerbanner3,.banner1,.banner2,.banner3,.banner4,.banner5,.banner6,.headerbanner1-bg").css("background-color", CC18);
                            $(hCK).find(".headerbanner1,.headerbanner2,.headerbanner3,.banner1,.banner2,.banner3,.banner4,.banner5,.banner6,.headerbanner1-bg").css("background-color", CC18);
                            mC18 = CC18
                        }
                    }
                }
                if (this.value && this.value != n.color) {
                    this.value = n.color;
                    $(this).trigger("change")
                }
                e(t)
            })
        } else if (typeof n.callback == "function") {
            n.callback.call(n, n.color)
        }
    };
    n.absolutePosition = function(e) {
        var t = {
            x: e.offsetLeft,
            y: e.offsetTop
        };
        if (e.offsetParent) {
            var r = n.absolutePosition(e.offsetParent);
            t.x += r.x;
            t.y += r.y
        }
        return t
    };
    n.pack = function(e) {
        var t = Math.round(e[0] * 255);
        var n = Math.round(e[1] * 255);
        var r = Math.round(e[2] * 255);
        return "#" + (t < 16 ? "0" : "") + t.toString(16) + (n < 16 ? "0" : "") + n.toString(16) + (r < 16 ? "0" : "") + r.toString(16)
    };
    n.unpack = function(e) {
        if (e.length == 7) {
            return [parseInt("0x" + e.substring(1, 3)) / 255, parseInt("0x" + e.substring(3, 5)) / 255, parseInt("0x" + e.substring(5, 7)) / 255]
        } else if (e.length == 4) {
            return [parseInt("0x" + e.substring(1, 2)) / 15, parseInt("0x" + e.substring(2, 3)) / 15, parseInt("0x" + e.substring(3, 4)) / 15]
        }
    };
    n.HSLToRGB = function(e) {
        var t, n, r, i, s;
        var o = e[0],
            u = e[1],
            a = e[2];
        n = a <= .5 ? a * (u + 1) : a + u - a * u;
        t = a * 2 - n;
        return [this.hueToRGB(t, n, o + .33333), this.hueToRGB(t, n, o), this.hueToRGB(t, n, o - .33333)]
    };
    n.hueToRGB = function(e, t, n) {
        n = n < 0 ? n + 1 : n > 1 ? n - 1 : n;
        if (n * 6 < 1) return e + (t - e) * n * 6;
        if (n * 2 < 1) return t;
        if (n * 3 < 2) return e + (t - e) * (.66666 - n) * 6;
        return e
    };
    n.RGBToHSL = function(e) {
        var t, n, r, i, s, o;
        var u = e[0],
            a = e[1],
            f = e[2];
        t = Math.min(u, Math.min(a, f));
        n = Math.max(u, Math.max(a, f));
        r = n - t;
        o = (t + n) / 2;
        s = 0;
        if (o > 0 && o < 1) {
            s = r / (o < .5 ? 2 * o : 2 - 2 * o)
        }
        i = 0;
        if (r > 0) {
            if (n == u && n != a) i += (a - f) / r;
            if (n == a && n != f) i += 2 + (f - u) / r;
            if (n == f && n != u) i += 4 + (u - a) / r;
            i /= 6
        }
        return [i, s, o]
    };
    $("*", r).mousedown(n.mousedown);
    n.setColor("#000000");
    if (t) {
        n.linkTo(t)
    }
}