$(function() {
    function Fr() {
        $("#dpmenu1").find("li").live("click", function() {
            $("#dpmenu1 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu1").find(".selected").text(e);
            $(this).addClass("active");
            $n.find("h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6").not(".footer .h6").css({
                "font-family": e
            });
            Jn.find("h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6").not(".footer .h6").css({
                "font-family": e
            })
        });
        $("#dpmenu2").find("li").live("click", function() {
            $("#dpmenu2 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu2").find(".selected").text(e);
            $(this).addClass("active");
            $n.find("h1,.h1").css({
                "font-weight": e
            });
            Jn.find("h1,.h1").css({
                "font-weight": e
            })
        });
        $("#dpmenu3").find("li").live("click", function() {
            $("#dpmenu3 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu3").find(".selected").text(e);
            $(this).addClass("active");
            $n.find("h2,.h2").css({
                "font-weight": e
            });
            Jn.find("h2,.h2").css({
                "font-weight": e
            })
        });
        $("#dpmenu4").find("li").live("click", function() {
            $("#dpmenu4 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu4").find(".selected").text(e);
            $(this).addClass("active");
            $n.find("h3,.h3").css({
                "font-weight": e
            });
            Jn.find("h3,.h3").css({
                "font-weight": e
            })
        });
        $("#dpmenu5").find("li").live("click", function() {
            $("#dpmenu5 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu5").find(".selected").text(e);
            $(this).addClass("active");
            $n.find("h4,.h4").css({
                "font-weight": e
            });
            Jn.find("h4,.h4").css({
                "font-weight": e
            })
        });
        $("#dpmenu6").find("li").live("click", function() {
            $("#dpmenu6 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu6").find(".selected").text(e);
            $(this).addClass("active");
            $n.find("h5,.h5").css({
                "font-weight": e
            });
            Jn.find("h5,.h5").css({
                "font-weight": e
            })
        });
        $("#dpmenu7").find("li").live("click", function() {
            $("#dpmenu7 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu7").find(".selected").text(e);
            $(this).addClass("active");
            $n.find("h6,.h6").css({
                "font-weight": e
            });
            Jn.find("h6,.h6").css({
                "font-weight": e
            })
        });
        $("#dpmenu8").find("li").live("click", function() {
            $("#dpmenu8 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu8").find(".selected").text(e);
            $(this).addClass("active");
            $n.find(".content,.content p").not(".number-td.content").css({
                "font-family": e
            });
            Jn.find(".content,.content p").not(".number-td.content").css({
                "font-family": e
            })
        });
        $("#dpmenu9").find("li").live("click", function() {
            $("#dpmenu9 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu9").find(".selected").text(e);
            $(this).addClass("active");
            $n.find(".content,.content p").not(".number-td.content").css({
                "font-weight": e
            });
            Jn.find(".content,.content p").not(".number-td.content").css({
                "font-weight": e
            })
        });
        $("#dpmenu10").find("li").live("click", function() {
            $("#dpmenu10 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu10").find(".selected").text(e);
            $(this).addClass("active");
            $n.find(".footer .h6").css({
                "font-family": e
            });
            Jn.find(".footer .h6").css({
                "font-family": e
            })
        });
        $("#dpmenu11").find("li").live("click", function() {
            $("#dpmenu11 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu11").find(".selected").text(e);
            $(this).addClass("active");
            $n.find(".footer .h6").css({
                "font-weight": e
            });
            Jn.find(".footer .h6").css({
                "font-weight": e
            })
        });
        $("#dpmenu12").find("li").live("click", function() {
            $("#dpmenu12 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu12").find(".selected").text(e);
            $(this).addClass("active");
            $n.find(".number-td.content").css({
                "font-family": e
            });
            Jn.find(".number-td.content").css({
                "font-family": e
            })
        });
        $("#dpmenu13").find("li").live("click", function() {
            $("#dpmenu13 li").removeClass("active");
            var e = $(this).text();
            $("#dpmenu13").find(".selected").text(e);
            $(this).addClass("active");
            $n.find(".number-td.content").css({
                "font-weight": e
            });
            Jn.find(".number-td.content").css({
                "font-weight": e
            })
        })
    }

    function Ir() {
        guideInfoText && xn.html(guideInfoText).css({
            opacity: 0,
            display: "block"
        }).animate({
            opacity: 1
        }, 4e3) || xn.hide()
    }

    function qr() {
        function e() {

        }
        window.onload = e
    }

    function Rr() {
        var t = $n.html();
        sPn = sr.val();
        $.generateFile({
            filename: sPn,
            content: t,
            script: "download.php"
        });
        e.preventDefault()
    }

    function Ur() {
        ur.click(function() {
            ir.slideUp("fast");
            rr.removeClass("active");
            or.slideToggle("fast");
            ur.toggleClass("active")
        });
        or.find("a").click(function() {
            if (isDemo == false) {
                Rr()
            } else {
                _t.css({
                    "border-width": "0px"
                }).animate({
                    marginTop: "0px",
                    marginLeft: "75px"
                })
            }
        })
    }

    function zr() {
        rr.click(function() {
            or.slideUp("fast");
            ur.removeClass("active");
            ir.slideToggle("fast");
            rr.toggleClass("active")
        })
    }

    function Wr() {
        $("#minFbox").click(function() {
            ir.slideUp("fast")
        });
        $("#minPbox").click(function() {
            or.slideUp("fast")
        });
        ur.removeClass("active");
        rr.removeClass("active")
    }

    function Xr() {
        var e = fbta.test(rn.html());
        if (e != 1) {
            return false
        }
        kr = zhengai, Lr = fuliz, Ar = duizhunag
    }

    function Vr() {
        Pr.html(Lr);
        Hr.html(Ar);
        Br.find(".selected").html("font-family");
        jr.find(".selected").html("font-weight");
        Dr.click(function() {
            var e = Cr.val();
            var t = e.match(kr);
            if (t == null) {
                Cr.val("pls input right google API!")
            } else {
                var n = $n.html().replace(kr, ""),
                        r = /\<style\s*type=\"text\/css\">[\s\S]*\<\/style\>/i,
                        i = n.match(r),
                        i = t + "\n" + i,
                        n = n.replace(r, i);
                $n.html(n).css({
                    opacity: "0.3"
                }).animate({
                    opacity: 1
                }, 2500);
                var s = t[0].replace(apit1, "").replace(apit2, "").replace(apit3, "").replace(apit4, "").replace(apit5, "").replace(apit6, "").replace(apit7, " ").replace(apit8, "");
                var o = s.match(apifg);
                if (o == null) {
                    var u = "<li>" + s + ", serif</li>" + Lr;
                    Pr.html("").html(u)
                } else {
                    var a = s.split("|"),
                            u = "";
                    $.each(a, function(e, t) {
                        u += "<li>" + t + ", serif</li>"
                    });
                    u += Lr;
                    Pr.html(u)
                }
            }
        })
    }

    function $r() {
        Br.click(function() {
            $(this).toggleClass("open");
            Br.find("div").css({
                "z-index": 2
            });
            $(this).find("div").slideToggle("fast").css({
                "z-index": 3
            })
        });
        jr.click(function() {
            $(this).toggleClass("open");
            jr.find("div").css({
                "z-index": 2
            });
            $(this).find("div").slideToggle("fast").css({
                "z-index": 3
            })
        })
    }

    function Jr() {
        function t(e) {
            if (typeof e !== "number") {
                return ""
            }
            if (e >= 1e9) {
                return (e / 1e9).toFixed(2) + " GB"
            }
            if (e >= 1e6) {
                return (e / 1e6).toFixed(2) + " MB"
            }
            return (e / 1e3).toFixed(2) + " KB"
        }
        var e = window.location.hostname === "blueimp.github.io" ? "//jquery-file-upload.appspot.com/" : "server/php/";
        $(document).on("drop dragover", function(e) {
            e.preventDefault()
        })
    }

    function Kr() {
        var e = IPuL + pName;
        $.get(e, function(e) {
            $n.html("").html(e).css({
                opacity: "0.3"
            }).animate({
                opacity: 1
            }, 1e3);
            Qr();
            setTimeout(function() {
                Ii();
                repk = 1
            }, 2500);
            setTimeout("$.post('delete.php')", 3e3);
            if (OptS == 1) {
            }
            $n.find(Id + ":first").addClass("this-module")
        });
        Xn.html("Upload succcess, and the uploaded file will be deleted from temp folder after uploading...").fadeIn(1e3);
        ir.slideUp(600);
        rr.removeClass("active");
        $("#files").html("")
    }

    function Qr() {
        if (OptS != 1) {
            setTimeout(function() {
                $("#iframe div[rev]").attr({
                    contenteditable: "true"
                }).ckeditor()
            }, 1e3)
        }
    }

    function Gr() {
        tr.click(function() {
            nr.removeClass("active");
            $(this).addClass("active");
            Xn.html("Edit Layout, can not edit contents, click/drag or delete/duplicat/clear all/sort modules.").fadeIn(1e3);
            OptS = 1;
            ui();
            $("#iframe div[rev]").attr("contenteditable", "false");
            $("#iframe div[rev]").attr({
                title: ""
            });
            $("#hide-iframe div[rev]").attr({
                title: ""
            });
            $n.find(Id).live("mouseenter", function() {
                var e = $(this).height() / 2 - 20;
                $(this).css({
                    "border-top": "#20B2AA 1px dotted",
                    "border-bottom": "#20B2AA 1px dotted",
                    cursor: "move",
                    padding: "0"
                }).find(opt).css("top", e + "px").show();
                $n.find(Id).removeClass("this-module");
                $(this).addClass("this-module")
            }).live("mouseleave", function() {
                $(this).css("border", "none").find(opt).hide()
            })
        });
        nr.click(function() {
            tr.removeClass("active");
            $(this).addClass("active");
            if ($.browser.msie) {
                Xn.html("<div>Edit Content, can not drag, If ckeditor toolbar not show or can not edit, click the <span>[ Edit Contetn ]</span> button again or refresh the page.<br> <span>IE browser may show some unwanted space, do not worry, due to ckeditor,will not affect the final page.</span></div>").fadeIn(1e3)
            } else {
                Xn.html("Edit Content, can not drag, click can be use, If ckeditor toolbar not show or can not edit, click the <span>[ Edit Contetn ]</span> button again or refresh the page.").fadeIn(1e3)
            }

            setTimeout(function() {
                $("#iframe div[rev]").attr({
                    contenteditable: "true"
                }).ckeditor();
                OptS = 0;
                oi();
                $n.find(Id).live("mouseenter", function() {
                    $(this).css({
                        "border-top": "#20B2AA 1px dotted",
                        "border-bottom": "#20B2AA 1px dotted",
                        cursor: "text",
                        padding: "0"
                    });
                    $n.find(Id).removeClass("this-module");
                    $(this).addClass("this-module").find(opt).hide()
                }).live("mouseleave", function() {
                    $(this).css("border", "none")
                })
            }, 500)
        });
        rr.click(function() {
            qr()
        })
    }

    function Yr() {
        Sn.click(function() {
            Dt.css({
                "border-width": "0px"
            }).animate({
                marginTop: "37px",
                marginLeft: "75px"
            }, 400)
        });
        $('li[rel="welcome"], li[rel="function"], li[rel="info"], li[rel="install"], li[rel="file"], li[rel="psd"], li[rel="three"], li[rel="credit"], li[rel="import"],li[rel="faq"]').click(function() {
            Dt.removeClass("leftdiv").animate({
                marginTop: "37px",
                marginLeft: "75px"
            }, 150)
        });
        $('li[rel="choose module"],li[rel="layout"],li[rel="color"],li[rel="bg"],li[rel="gAPI"],li[rel="download"],li[rel="copyright"],li[rel="guide"]').click(function() {
            Dt.removeClass("leftdiv").animate({
                marginTop: "37px",
                marginLeft: "325px"
            }, 150)
        });
        $('li[rel="choose module"]').click(function() {
            Jt.hide();
            Ft.removeClass("active");
            qt.addClass("active");
            Gt.slideDown(500)
        });
        $('li[rel="layout"]').click(function() {
            Jt.hide();
            Ft.removeClass("active");
            It.addClass("active");
            Qt.slideDown(500)
        });
        $('li[rel="color"]').click(function() {
            Jt.hide();
            Ft.removeClass("active");
            Rt.addClass("active");
            Yt.slideDown(500)
        });
        $('li[rel="bg"]').click(function() {
            Ft.removeClass("active");
            Ut.addClass("active");
            Jt.hide();
            _n.find(".accordion").hide();
            Ln.show();
            Zt.slideDown(500)
        });
        $('li[rel="gAPI"]').click(function() {
            Ft.removeClass("active");
            Nr.addClass("active");
            Jt.hide();
            Pn.find(".accordion").hide();
            Hn.show();
            Or.slideDown(500)
        });
        $('li[rel="download"]').click(function() {
            Jt.hide();
            Ft.removeClass("active");
            zt.addClass("active");
            en.slideDown(500)
        });
        $('li[rel="copyright"]').click(function() {
            Jt.hide();
            Ft.removeClass("active");
            Wt.addClass("active");
            tn.slideDown(500)
        });
        $('li[rel="guide"]').click(function() {
            Jt.hide();
            Ft.removeClass("active");
            Xt.addClass("active");
            nn.slideDown(500)
        });
        $('li[rel="myitem"],li[rel="responsive"],li[rel="theme"],li[rel="operate"]').click(function() {
            Dt.addClass("leftdiv").animate({
                marginTop: "37px",
                marginLeft: "0px"
            }, 150)
        });
        $("#cancelTabs").click(function() {
            Dt.css({
                "border-width": "0px"
            }).animate({
                marginTop: "9999px"
            }, 300)
        });
        $("#tabs").tabs({
            beforeLoad: function(e, t) {
                t.jqXHR.error(function() {
                    t.panel.html("Couldn't load this tab. We'll try to fix this as soon as possible. " + "If this wouldn't be a demo.")
                })
            }
        })
    }

    function Zr() {
        var e = location.pathname.split("/");
        var t = e.length - 2;
        bFolderName = e[t];
        e.pop();
        patternPath = "../../" + bFolderName + "/pattern/";
        xr = RegExp(patternPath, "g");
        IPmL = location.protocol + "//" + location.host + e.join("/") + "/pattern/";
        IPuL = location.protocol + "//" + location.host + e.join("/") + "/server/php/files/";
        GdIl = location.protocol + "//" + location.host + e.join("/") + "/guide/" + "index.html";
        e.pop();
        var n = fbta.test(rn.html());
        if (n != 1) {
            return false
        }
        if (isDemo == true) {
            BDLJ = APP_URL + "/demo/"
        } else {
            BDLJ = APP_URL + "/template_builder/html/"
        }
        BDLJP = location.protocol + "//" + location.host + e.join("/");
        if (mLt == "all") {
// IL = BDLJ + mTm + "/21961.html"
        } else {
            if (templateName != "") {
                IL = BDLJ + userId + "/" + templateName + ".html"
            }
            else {
                IL = BDLJ + mTm + "/all-inline.html"
            }
        }

        //  console.log(userId)
        hIL = BDLJ + mTm + "/all-inline.html";
        IImL = '"' + BDLJ + mTm + "/images/";
        IBmL = "url(" + BDLJ + mTm + "/images/";
        ImmL = BDLJ + mTm + "/images/"
    }

    function ei(e) {
        CKDM = $n.html();
        var t = jsflay.test(CKDM);
        if (t != 1) {
            return false
        }
        Zn.html(CKDM);
        tCKDM = Zn.html();
        bi();
        tCKDM = Zn.html();
        Zn.find(opt).remove();
        Zn.find(Id).children().unwrap(Id);
        tCKDM = Zn.html();
        if (authorMode == false) {
            if (pS == "-mc") {
                Zn.find("layout").children().unwrap("layout")
            } else if (pS == "-cm") {
                Zn.find("layout").unwrap("div")
            } else {
                Zn.find("layout").unwrap("div");
                Zn.find("layout").children().unwrap("layout")
            }
        }
        pH = fn.val();
        Zn.find(".preheader").remove();
        $(tCK + " " + ".BGtable").before('<div class="preheader" style="display:none; visibility:hidden; height:0px; font-size:0px; line-height:0px;">' + pH + "</div>" + "\n");
        Xn.html("Preheader has been added...").css("display", "none").fadeIn(1e3);
        tCKDM = Zn.html();
        var n = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' + "\n" + '<html xmlns="http://www.w3.org/1999/xhtml">' + "\n" + "<head>" + "\n" + '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>' + "\n" + '<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"/>' + "\n",
                r = "</head>" + "\n" + '<body style="margin:0;padding:0;width:100%;height:100%;">' + "\n";
        var i = "\n" + "</body>" + "\n" + "</html>";
        var s = /\x3c\/style\x3e/g;
        var o = rn.html();
        var u = "\n" + "</style>" + "\n" + r;
        var a = /\x3ctitle\x3e[^<]+\x3c\/title\x3e/g;
        var f = /\u0067i\u0074\u0068\@/i;
        var l = "&copy;",
                c = "&raquo;",
                h = "'";
        var p = /\<tbody\>/g;
        var d = /\<\/tbody\>/g;
        var v = /2013\-Business\s*Template\,\s*All\s*rights\s*reserved/g;
        var m = RegExp("Unit No.100, Park Name, Area Name,<br>State, Country Name", "gi");
        var g = "<currentyear>-Business Template,  All rights reserved";
        var y = /0800\s*123\s*4567/g;
        var b = /mc:edit="[^"]+"/g,
                w = "2006 - *|CURRENT_YEAR|* *|LIST:COMPANY|*",
                E = "*|LIST:PHONE|*",
                S = /\*\|ARCHIVE\|\*/g,
                x = /\*\|LIST:ADDRESS\|\*/g,
                T = /\*\|LIST:URL\|\*/g,
                N = /\*\|FORWARD\|\*/g,
                C = /\*\|UNSUB\|\*/g,
                k = /\#\*\|ARCHIVE\|\*/g,
                L = /\#\*\|FORWARD\|\*/g,
                A = /\#\*\|UNSUB\|\*/g,
                O = /\#\*\|LIST:URL\|\*/g;
        var M = /\<webversion\>/g,
                _ = /\<\/webversion\>/g,
                D = /\<forwardtoafriend\>/g,
                P = /\<\/forwardtoafriend\>/g,
                H = /\<unsubscribe\>/g,
                B = /\<\/unsubscribe\>/g,
                j = /<singleline\s*label="[^"]+"\>/g,
                F = /\<\/singleline\>/g,
                I = /\<multiline\s*label="[^"]+"\>/g,
                q = /\<\/multiline\>/g,
                R = /\<currentyear\>/g,
                U = /\<\/currentyear\>/g,
                z = /editable="true"\s*label="[^"]+"/g;
        var W = /\<webversion\>\<a[^>]+\>/g,
                X = /\<\/a\>\<\/webversion\>/g,
                V = /\<forwardtoafriend\>\<a[^>]+\>/g,
                J = /\<\/a\>\<\/forwardtoafriend\>/g,
                K = /\<unsubscribe\>\<a[^>]+\>/g,
                Q = /\<\/a\>\<\/unsubscribe\>/g;
        tCKDM = n + tCKDM + i;
        pT = an.val();
        Phd = "<title>" + pT + pS + "</title>";
        tCKDM = tCKDM.replace(s, u);
        tCKDM = tCKDM.replace(CR, l).replace(RQQ, c).replace(QUOT, h);
        if (authorMode == true) {
            var t = RegExp(ImmL, "g");
            var G = RegExp(IPmL, "g");
            tCKDM = tCKDM.replace(t, "images/").replace(G, patternPath)
        } else {
            tCKDM = tCKDM.replace(p, "").replace(d, "").replace(hMediaNeiStart, "MediaNeiStart").replace(startMedia, "").replace(endMedia, "").replace(MediaNeiEnd, "").replace(MediaNeiStartQx, "")
        }
        Vi();
        tCKDM = tCKDM.replace(cke, "").replace(cke_e, "-->").replace(shibie, "◆").replace(ckeSave, "");
        tCKDM = unescape(tCKDM);
        if (authorMode == false) {
            if (pS == "-mc") {
                tCKDM = tCKDM.replace(v, w).replace(y, E).replace(a, "<title>*|MC:SUBJECT|*</title>").replace(m, "*|LIST:ADDRESS|*").replace(M, "").replace(_, "").replace(D, "").replace(P, "").replace(H, "").replace(B, "").replace(j, "").replace(F, "").replace(I, "").replace(q, "").replace(R, "").replace(U, "").replace(z, "").replace(k, "*|ARCHIVE|*").replace(L, "*|FORWARD|*").replace(A, "*|UNSUB|*").replace(O, "*|LIST:URL|*")
            } else if (pS == "-cm") {
                tCKDM = tCKDM.replace(v, g).replace(a, Phd).replace(S, "").replace(x, "").replace(T, "").replace(N, "").replace(C, "").replace(b, "").replace(W, "<webversion>").replace(X, "</webversion>").replace(V, "<forwardtoafriend>").replace(J, "</forwardtoafriend>").replace(K, "<unsubscribe>").replace(Q, "</unsubscribe>")
            } else {
                tCKDM = tCKDM.replace(a, Phd).replace(M, "").replace(_, "").replace(D, "").replace(P, "").replace(H, "").replace(B, "").replace(j, "").replace(F, "").replace(I, "").replace(q, "").replace(R, "").replace(U, "").replace(z, "").replace(S, "").replace(x, "").replace(T, "").replace(N, "").replace(C, "").replace(b, "")
            }
        } else {
            tCKDM = tCKDM.replace(a, Phd)
        }
        var Y = RgbT.test(tCKDM);
        if (Y == true) {
            rgbs = tCKDM.match(RgbT);
            rgbs = Hi(rgbs);
            var Z = [];
            if (f.test(o) != 1) {
                return false
            }
            $.each(rgbs, function(e) {
                Z[e] = Bi(rgbs[e]);
                var t = rgbs[e].split("(");
                var n = t[0];
                var r = t[1];
                var i = r.split(")");
                var s = i[0];
                var o = RegExp(n + "[(]{1}" + s + "[)]{1}", "g");
                tCKDM = tCKDM.replace(o, Z[e])
            })
        }
        if (location.protocol == "http:") {
            Xn.html("Summary, version: [ " + pC + " ] File name: [ " + pT + " ]").css("display", "none").fadeIn(200)
        } else {
            Xn.html("<span>*** [ It looks you do not upload the template builder in the right way, pls do not use it in your local pc file system( begin with file:///) ] ***</span>").fadeIn(1e3)
        }
        var et = /\<v:fill[^>]+msoBG-1"\s*\>/gi;
        var tt = '<v:fill type="tile" src="' + BgImgUrl1 + '" color="' + mC18 + '" id="msoBG-1" />';
        var nt = /\<v:fill[^>]+msoBG-2"\s*\>/gi;
        var rt = '<v:fill type="tile" src="' + BgImgUrl2 + '" color="' + mC18 + '" id="msoBG-2" />';
        var it = /\<v:fill[^>]+msoBG-3"\s*\>/gi;
        var st = '<v:fill type="tile" src="' + BgImgUrl3 + '" color="' + mC18 + '" id="msoBG-3" />';
        var ot = /\<v:fill[^>]+msoBG-4"\s*\>/gi;
        var ut = '<v:fill type="tile" src="' + BgImgUrl4 + '" color="' + mC18 + '" id="msoBG-4" />';
        var at = /\<v:fill[^>]+msoBG-5"\s*\>/gi;
        var ft = '<v:fill type="tile" src="' + BgImgUrl5 + '" color="' + mC18 + '" id="msoBG-5" />';
        var lt = /\<v:fill[^>]+msoBG-6"\s*\>/gi;
        var ct = '<v:fill type="tile" src="' + BgImgUrl6 + '" color="' + mC18 + '" id="msoBG-6" />';
        var ht = /\<v:fill[^>]+msoBG-7"\s*\>/gi;
        var pt = '<v:fill type="tile" src="' + BgImgUrl7 + '" color="' + mC18 + '" id="msoBG-7" />';
        var dt = /\<v:fill[^>]+msoBG-8"\s*\>/gi;
        var vt = '<v:fill type="tile" src="' + BgImgUrl8 + '" color="' + mC18 + '" id="msoBG-8" />';
        var mt = /\<v:fill[^>]+msoBG-9"\s*\>/gi;
        var gt = '<v:fill type="tile" src="' + BgImgUrl9 + '" color="' + mC18 + '" id="msoBG-9" />';
        var yt = /\<\/v:fill\>/gi;
        tCKDM = tCKDM.replace(konghang, "");
        tCKDM = tCKDM.replace(yt, "").replace(et, tt).replace(nt, rt).replace(it, st).replace(ot, ut).replace(at, ft).replace(lt, ct).replace(ht, pt).replace(dt, vt).replace(mt, gt);
        $.generateFile({
            filename: pT,
            content: tCKDM,
            script: "download.php"
        });
        e.preventDefault()
    }

    function ti(e) {
        repk = 0;
        if (zhixingfou == undefined) {
            if (location.protocol !== "http:") {
                Xn.html("<span>*** [ It looks you do not upload the template builder in the right way, pls do not use it in your local pc file system( begin with file:///) ] ***</span>").fadeIn(1e3)
            } else {
                Xn.html("<span>***Do you upload the [ html ] file onto your server? you should upload both [ digith_template_builder ] and [ html ] folder***</span>").css("display", "none").fadeIn(1e3)
            }
        }
        $.get(e, function(e) {
            var t = jsflay.test(e);
            if (t != 1) {
                return false
            }
            CKDM = e;
            CKDM = CKDM.replace(meta, "");
            TS = CKDM.match(YY);
            if (bFolderName != "digith_template_builder") {
                var n = RegExp(bFolderName, "gi");
                CKDM = CKDM.replace(n, bFolderName)
            }
            gi(TS);
            $.ajaxSetup({
                cache: false
            });
            Qn.removeClass("active");
            cr.addClass("active");
            $n.css({
                "max-height": "none",
                "border-width": "0px"
            }).animate({
                width: "100%",
                maxHeight: "100%",
                marginBottom: "0"
            }, 400);
            $n.html("").html(CKDM).css({
                opacity: "0.3"
            }).animate({
                opacity: 1
            }, 2500);
            Vr();
            Qr();
            if (OptS == 1) {
                setTimeout(function() {
                    $("#iframe div[rev]").attr("contenteditable", "false");
                    ji(0);
                    Pt.animate({
                        marginTop: "9999px"
                    }, 500);
                    Ii();
                    repk = 1
                }, 2500)
            } else {
                Ii();
                repk = 1
            }
            $n.find(Id + ":first").addClass("this-module");
            CKDM = $n.html();
            mLg = $n.find(Id).length;
            if (zhixingshu == 0) {
                if (isDocumentaion == true) {
                    Dt.addClass("leftdiv").css({
                        "border-width": "0px"
                    }).animate({
                        marginTop: "37px",
                        marginLeft: "0"
                    }, 1e3)
                }
                zhixingfou = 1;
                ii()
            } else {
                zhixingshu = 1
            }
        })
    }

    function ni(e) {
        $.get(e, function(e) {
            var t = jsflay.test(e);
            if (t != 1) {
                return false
            }
            hCKDM = e;
            hCKDM = hCKDM.replace(meta, "");
            hCKDM = hCKDM.replace(media, "");
            if (bFolderName != "digith_template_name") {
                var n = RegExp(bFolderName, "gi");
                CKDM = CKDM.replace(n, bFolderName)
            }
            hTS = hCKDM.match(YY);
            yi(hTS);
            Jn.html(hCKDM)
        })
    }

    function ri() {
        In.click(function(e) {
            if (isDemo == false) {

                mLg = $n.find(Id).length;
                if (mLg == 0) {
                    Xn.html("<span>***   You have not choose any modules , please selete modules and add them to your page.   ***</span>").css("display", "none").fadeIn(1e3)
                } else {
                    Xn.html("Ready for download page, Please wait...").css("display", "none").fadeIn(1e3);
                    ei(e)
                }
            } else {
                _t.css({
                    "border-width": "0px"
                }).animate({
                    marginTop: "0px",
                    marginLeft: "75px"
                })
            }
        });
        _t.click(function() {
            _t.css({
                "border-width": "0px"
            }).animate({
                marginTop: "9999px"
            })
        })
    }

    function ii() {
        if (zhixingshu == 1) {
            return false
        }
        if (location.protocol !== "http:") {
            Xn.html("<span>*** [ It looks you do not upload the template builder in the right way, pls do not use it in your local pc file system( begin with file:///) ] ***</span>").fadeIn(1e3)
        } else if (mLg == undefined) {
            Xn.html("<span>***Do you upload the [ html ] file onto your server? you should upload both [ digith_template_builder ] and [ html ] folder***</span>").css("display", "none").fadeIn(1e3)
        } else {
            Xn.html("The builder has been upload success. Suggest using webkit browser(e.g chrome, safri...), faster than IE.").fadeIn(1e3)
        }
        if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.match(/7./i) == "7.") {
            Xn.html("The template builder have not full tested in IE7/IE8 browser, if has problems, please update your IE browser or use other browsers.").fadeIn(1e3)
        }
        zhixingshu = 1
    }

    function si() {
        $(BJ + " a").each(function(e) {
            br[e] = $(this).attr("id");
            Er = br[0];
            pi(br[e])
        });
        $(ZT + " a").each(function(e) {
            wr[e] = $(this).attr("id");
            Sr = wr[0];
            vi(wr[e])
        })
    }

    function oi() {
        if (OptS == 1) {
            return false
        }
        $n.sortable("destroy");
        $("li.item").draggable("destroy")
    }

    function ui() {
        if (OptS != 1) {
            return false
        }
        $n.sortable({
            items: Id,
            placeholder: "placehold",
            receive: function(e, t) {

                $(CK + " li.item").css({
                    "list-style-type": "none",
                    display: "none"
                }).after(colne_M).next(Id).css({
                    opacity: 0
                }).animate({
                    opacity: 1
                }, 300).animate({
                    opacity: 0
                }, 100).animate({
                    opacity: 1
                }, 600);
                $(CK + " li.item").remove();
                Xn.html("module:  [ " + mT + " ]  has been added to the email page.").css("display", "none").fadeIn(1e3)
            },
            start: function(e, t) {
                hi(t)
            },
            axis: "y",
            tolerance: "pointer",
            revert: 300,
            stop: function(e, t) {
                //   console.log($n.html());
                ci(t);
                CKDM = $n.html();
                $("#iframe div[rev]").ckeditor();
                if (OptS == 1) {
                    setTimeout(function() {
                        $("#iframe div[rev]").attr("contenteditable", "false")
                    }, 1e3)
                }
            }
        });
        $("li.item").draggable({
            connectToSortable: CK,
            helper: "clone",
            distance: 20,
            drag: function(e, t) {
                // console.log("hello");
                h = t.helper.find("img").height() + "px";
                mT = $(this).attr("id");
                $(CK + " .placehold").css({
                    height: h,
                    padding: "5px",
                    "box-shadow": "none"
                });
                t.helper.css({
                    opacity: "1",
                    border: "none",
                    "box-shadow": "none"
                });
                t.helper.find("img").css({
                    width: eW,
                    height: "auto"
                })
            },
            revert: "invalid",
            stop: function(e, t) {

                scrollPosi = $n.scrollTop();
                $n.scrollTop(scrollPosi);
                //$n.find(".BGtable").append(scrollPosi); 
                var n = $(this).attr("id");
                colne_M = Jn.find("[rev=" + n + "]").clone()
            }
        })

    }

    function ai() {
        $.each(RQz, function(e) {
            var t = RQz.length - 1;
            $("#" + RQz[e] + "Content" + " .item").click(function() {
                var n = $(this).attr("id");
                colne_M = Jn.find("[rev=" + n + "]").clone();
                var r = $(CK + " " + RQm[e]).find(".this-module").length;
                if (r != 0) {
                    $(colne_M).css({
                        display: "none"
                    });
                    $(CK + " " + ".this-module").before(colne_M).prev(Id).slideDown(400).css({
                        opacity: 0
                    }).animate({
                        opacity: 1
                    }, 200).animate({
                        opacity: 0
                    }, 50).animate({
                        opacity: 1
                    }, 300)
                } else {
                    if (e == t) {
                        $(CK + " " + RQm[e]).append(colne_M).find(Id + ":last").css({
                            opacity: 0
                        }).animate({
                            opacity: 1
                        }, 300).animate({
                            opacity: 0
                        }, 100).animate({
                            opacity: 1
                        }, 600)
                    } else {
                        $(CK + " " + RQm[e]).prepend(colne_M).find(Id + ":first").css({
                            opacity: 0
                        }).animate({
                            opacity: 1
                        }, 300).animate({
                            opacity: 0
                        }, 100).animate({
                            opacity: 1
                        }, 600)
                    }
                }
                $(this).removeClass("this-module");
                $("#iframe div[rev]").ckeditor();
                if (OptS == 1) {
                    setTimeout(function() {
                        $("#iframe div[rev]").attr("contenteditable", "false")
                    }, 1e3)
                }
                Xn.html("module: [ " + n + " ] has been added to the email page.").css("display", "none").fadeIn(1e3);
                CKDM = $n.html()
            });
            $("#" + RQz[e] + "Content" + " .item").live("mousemove", function() {
                $(this).css({
                    opacity: "0.8",
                    border: "olive 1px dotted",
                    padding: "1px",
                    "box-shadow": "2px 2px 2px #222"
                })
            });
            $("#" + RQz[e] + "Content" + " .item").live("mouseout", function() {
                $(this).css({
                    opacity: "1",
                    border: "none",
                    animation: "0.4s",
                    "box-shadow": "none"
                })
            })
        })
    }

    function fi() {
        if (isDarkk == true) {
            Ot.removeClass("active");
            Mt.addClass("active");
            At.removeClass("lightt").addClass("darkk")
        }
        if (isDarkk == false) {
            Mt.removeClass("active");
            Ot.addClass("active");
            At.removeClass("darkk").addClass("lightt")
        }
        Mt.click(function() {
            $(this).addClass("active");
            Ot.removeClass("active");
            At.removeClass("lightt").addClass("darkk");
            Xn.html("You choosed the dark Template Builder Theme.").css("display", "none").removeClass("lightt").addClass("darkk").fadeIn(1e3)
        });
        Ot.click(function() {
            $(this).addClass("active");
            Mt.removeClass("active");
            At.removeClass("darkk").addClass("lightt");
            Xn.html("You choosed the light Template Builder Theme.").css("display", "none").removeClass("darkk").addClass("lightt").fadeIn(1e3)
        })
    }

    function li() {
        $n.find(Id).live("mouseenter", function() {
            var e = $(this).height() / 2 - 20;
            $(this).css({
                "border-top": "#20B2AA 1px dotted",
                "border-bottom": "#20B2AA 1px dotted",
                cursor: "move",
                padding: "0"
            }).find(opt).css("top", e + "px").show();
            $n.find(Id).removeClass("this-module");
            $(this).addClass("this-module")
        }).live("mouseleave", function() {
            $(this).css("border", "none").find(opt).hide()
        });
        $n.find(dlt).live("click", function() {
            var e = $(this).parent().parent(Id);
            $(e).css({
                opacity: 0
            }).animate({
                opacity: 1
            }, 200).hide(400);
            setTimeout(function() {
                $(e).remove()
            }, 600);
            var t = e.attr("rev");
            Xn.html("Module [ " + t + " ]  has been deleted......").css("display", "none").fadeIn(1e3);
            CKDM = $n.html()
        });
        $n.find(clr).live("click", function() {
            $n.find(Id).remove();
            Xn.html("<span>All Modules has been deleted, please click left items to add modules to the right position, do not using dragging to the window......</span>").css("display", "none").fadeIn(1e3);
            CKDM = $n.html()
        });
        $n.find(dpt).live("click", function() {
            $(this).parent().hide();
            var e = $(this).parent().parent(Id);
            var t = $(this).parent().parent(Id).clone();
            e.removeClass("this-module");
            t.addClass("this-module");
            var n = e.attr("rev");
            $(e).after(t);
            $(e).next().css({
                opacity: 0
            }).animate({
                opacity: 1
            }, 300).animate({
                opacity: 0
            }, 100).animate({
                opacity: 1
            }, 600);
            Xn.html("Module [ " + n + " ] has been duplicated......").css("display", "none").fadeIn(1e3);
            CKDM = $n.html()
        })
    }

    function ci(e) {
        var t = e.item.height();
        $(".placehold").css({
            height: t
        });
        e.item.css({
            opacity: 0
        });
        e.item.animate({
            opacity: 1
        }, 300);
        e.item.animate({
            opacity: 0
        }, 100);
        e.item.animate({
            opacity: 1
        }, 600)
    }

    function hi(e) {
        var t = e.item.height();
        $(".placehold").css({
            height: t
        })
    }

    function pi(e) {
        $("#" + e).click(function() {
            Er = e;
            $("a").removeClass("active_layout");
            $(this).addClass("active_layout");
            di(Sr, Er)
        })
    }

    function di(e, t) {
        IL = BDLJ + e + "/" + t + ".html";
        hIL = BDLJ + e + "/" + "all-inline.html";
        ti(IL);
        ni(hIL);
        $n.ready(function() {
            iframe_height()
        })
    }

    function vi(e) {
        $("#" + e).click(function() {
            var e = $(this).attr("id");
            Sr = e;
            mTm = e;
            $("a").removeClass("active_layout");
            $("a").removeClass("active_theme");
            $(this).addClass("active_theme");
            $("#" + Er).addClass("active_layout");
            IL = BDLJ + e + "/" + Er + ".html";
            hIL = BDLJ + e + "/" + "all-inline.html";
            IImL = '"' + BDLJ + e + "/images/";
            IBmL = "url(" + BDLJ + e + "/images/";
            ImmL = BDLJ + e + "/images/";
            ti(IL);
            ni(hIL)
        })
    }

    function mi(e, t) {
        $.farbtastic(e).setColor(t.val())
    }

    function gi(e) {
        CKDM = CKDM.replace(imgL, IImL);
        CKDM = CKDM.replace(imgLb, IBmL);
        CKDM = CKDM.replace(xr, IPmL);
        e = Hi(e);
        $.each(e, function(e, t) {
            var n = RegExp(/start/g);
            var r = RegExp(/end/g);
            var i = n.test(t);
            var s = t.split("◆");
            var o = RegExp(t, "g");
            var u = s[1];
            if (i == true) {
                tihuan = '<div  rev="' + u + '" contenteditable="true">' + t;
                tihuan += '<div class="options"><div class="delete" title="Delete the Module">-</div><div class="duplicate" title="Duplicate the Module">+</div><div class="clear" title="If clear all, pls click left items to put modules in the proper position,do not use dragging to the page window.">Clear<br/>All</div></div>'
            } else {
                tihuan = t + "\n" + "</div>"
            }
            CKDM = CKDM.replace(o, tihuan)
        })
    }

    function yi(e) {
        $.each(e, function(e, t) {
            c = /start/g;
            d = /end/g;
            test = c.test(t);
            var n = t.split("◆");
            var r = n[1];
            if (test == true) {
                tihuan = '<div rev="' + r + '" contenteditable="true">' + t;
                tihuan += '<div class="options"><div class="delete" title="Delete the Module">-</div><div class="duplicate" title="Duplicate the Module">+</div><div class="clear" title="If clear all, pls click left items to put modules in the proper position,do not use dragging to the page window.">Clear<br/>All</div></div>'
            } else {
                tihuan = t + "\n" + "</div>"
            }
            hCKDM = hCKDM.replace(imgL, IImL);
            hCKDM = hCKDM.replace(imgLb, IBmL);
            hCKDM = hCKDM.replace(xr, IPmL);
            hCKDM = hCKDM.replace(t, tihuan)
        })
    }

    function bi() {
        $.each(RQm, function(e) {
            var t = RQm[e];
            var n = $(tCK + " " + t).find(Id);
            $.each(n, function(e) {
                var n = $(this).attr("rev");
                var r = $(this).clone();
                var i = $(r).html();
                var s = $(tCK + " " + t).find("[rev=" + n + "]").length;
                if (pS == "-cm") {
                    var o = $(r).html();
                    var u = /\<layout\s+label[^>]+\>/i;
                    var a = u.test(o);
                    if (a == 1) {
                        $(r).addClass("repeater");
                        if (s > 0) {
                            var f = o.match(u);
                            var l = f[0];
                            var c = l.split('"');
                            var h = RegExp('"' + c[1] + '"', "gi");
                            var p = '"' + c[1] + s + '"';
                            var d = o.replace(h, p);
                            $(r).html(d).attr("rev", p)
                        }
                    }
                }
                $(tCK + " " + t).append(r);
                $(this).remove();
                var v = Zn.html()
            });
            if (pS == "-cm") {
                $(tCK + " " + t + " .repeater").wrapAll("<repeater></repeater>")
            }
        })
    }

    function wi() {
        a = Lt.height() - 43 + "px";
        b = Lt.height() - 80 + "px";
        c = Lt.height() - 37 + "px";
        d = Lt.height() - 77 + "px";
        g = Lt.height() - 151 + "px";
        ga = Lt.height() - 156 + "px";
        gb = Lt.height() - 172 + "px";
        h = Lt.width() - 361 + "px";
        i = Lt.width() - 325 + "px";
        j = Lt.height() - 127 + "px";
        k = Lt.height() - 80 - 68 - 30 - 30 * 5 + "px";
        Tr.css({
            height: gb
        });
        $t.css({
            height: c
        });
        Dt.css({
            maxHeight: c
        });
        Gt.css({
            height: a,
            "max-height": a
        });
        Tn.css({
            "max-height": d
        });
        Tn.find("div").css({
            "max-height": j
        });
        Nn.css({
            "max-height": ga
        });
        Cn.css({
            "max-height": ga
        });
        kn.css({
            "max-height": ga
        });
        Ln.find("div.pattern").css({
            "max-height": k
        });
        Vn.css({
            width: h,
            height: b
        });
        ir.css({
            "max-height": b
        });
        Pt.css({
            width: i,
            height: c
        });
        $n.css({
            height: b
        })
    }

    function Ei() {
        Ht.niceScroll({
            cursorcolor: "#E62020",
            zindex: 5,
            cursoropacitymax: 1,
            touchbehavior: false,
            cursorwidth: "6px",
            cursorborder: "0",
            cursorborderradius: "0px",
            railalign: "left",
            railpadding: {
                top: 0,
                right: 0,
                left: 0,
                bottom: 0
            },
            hidecursordelay: 400
        });
        $n.niceScroll({
            cursorcolor: "#E62020",
            zindex: 6,
            cursoropacitymax: 1,
            cursoropacitymin: .4,
            touchbehavior: false,
            cursorwidth: "6px",
            cursorborder: "0",
            cursorborderradius: "6px",
            spacebarenabled: false,
            railalign: "right",
            railpadding: {
                top: 0,
                right: 0,
                left: 0,
                bottom: 0
            },
            hidecursordelay: 400
        })
    }

    function Si() {
        Kt.css({
            display: "none"
        }).hide();
        Qt.show()
    }

    function xi() {
        var e = "<ul>";
        $.each(ZTZ, function(t, n) {
            if (t == "theme1") {
                c = "active_theme "
            } else {
                c = ""
            }
            e += '<li><a title="' + n + '" id="' + n + '" class="' + c + t + '"></a></li>'
        });
        e += "</ul>";
        Rn.html(e);
        var t = "<ul>";
        $.each(BJZ, function(e, n) {
            if (n == "1") {
                c = ' class="active_layout"';
                d = "layout"
            } else if (n == "all") {
                c = "";
                d = ""
            } else {
                c = "";
                d = "layout"
            }
            t += '<li><a id="' + d + n + '-inline" title="' + d + n + '" ' + c + ">" + n + "</a></li>"
        });
        t += "</ul>";
        qn.html(t)
    }

    function Ti() {
        $.each(BuFen, function(e, t) {

            XZH += '<ul id="' + e + '"><li class="menu-list' + '">';
            $.each(t, function(t, n) {
                XZH += t + "</li></ul>" + '<div id="' + e + 'Content"><ul>';
                $.each(n, function(e, t) {
                    var n = "";
                    $.each(Itm, function(e, r) {
                        if (e == t) {
                            n = r;
                            return false
                        }
                    });

                    XZH += '<li class="item" id="' + t + '"><img src="' + location.protocol + "//" + location.host + "/" + 'template_builder/images/buju/' + t + '.jpg" title="' + n + '"></li>'
                });
                XZH += "</ul></div>"
            })
        });
        Tn.append(XZH);
        Fn.fadeIn(3e3).css("display", "inline-block")
    }

    function Ni() {
        var e = false;
        if (myItem == "") {
            er.html('<a id="template-list" class="noc" href="http://themeforest.net/user/digith/portfolio?ref=digith">See All My Email Templates with Builder</a>')
        } else {
            er.html(myItem).find("#template-list").click(function() {
                if (e == true) {
                    $(this).removeClass("highlighted");
                    $("#container").slideUp(200);
                    e = false
                } else {
                    $(this).addClass("highlighted");
                    $("#container").slideDown(200);
                    e = true
                }
                return false
            })
        }
        $thisshi = Vt.attr("rev");
        $("#container").each(function() {
            var e = $(this).find("a").attr("rel");
            if (e == $thisshi) {
                $theme_lk = $(this).find("a").attr("goumai");
                lr.attr("href", $theme_lk);
                return false
            }
        })
    }

    function Ci() {
        Tn.accordion({
            heightStyle: "content"
        });
        Nn.accordion({
            heightStyle: "content"
        });
        Cn.accordion({
            heightStyle: "content"
        });
        kn.accordion({
            heightStyle: "content"
        });
        Ln.accordion({
            heightStyle: "content"
        });
        An.accordion({
            heightStyle: "content"
        });
        On.accordion({
            heightStyle: "content"
        });
        Dn.accordion({
            heightStyle: "content"
        });
        Hn.accordion({
            heightStyle: "content"
        });
        Bn.accordion({
            heightStyle: "content"
        })
    }

    function ki() {
        mn.click(function() {
            Mn.find(".accordion").slideUp(200);
            Nn.slideDown(500)
        });
        gn.click(function() {
            Mn.find(".accordion").slideUp(200);
            Cn.slideDown(500)
        });
        yn.click(function() {
            Mn.find(".accordion").slideUp(200);
            kn.slideDown(500)
        })
    }

    function Li() {
        bn.click(function() {
            _n.find(".accordion").slideUp(200);
            An.slideDown(500)
        });
        wn.click(function() {
            _n.find(".accordion").slideUp(200);
            Ln.slideDown(500)
        });
        En.click(function() {
            _n.find(".accordion").slideUp(200);
            On.slideDown(500)
        })
    }

    function Ai() {
        Mr.click(function() {
            Pn.find(".accordion").slideUp(200);
            Hn.slideDown(500)
        });
        _r.click(function() {
            Pn.find(".accordion").slideUp(200);
            Bn.slideDown(500)
        })
    }

    function Oi() {
        $(".pattern").append(cPattern);
        $("li.patternItem").fadeIn(3e3).css("display", "inline-block")
    }

    function Mi() {
        qt.click(function() {
            Ft.removeClass("active");
            $(this).addClass("active");
            Jt.hide();
            Gt.slideDown();
            Xn.html("Please choose modules which you like, you can click/drag, and you can delete/duplicate/darg in the page window directly.").css("display", "none").fadeIn(1e3)
        });
        It.click(function() {
            Ft.removeClass("active");
            $(this).addClass("active");
            Jt.hide();
            Qt.slideDown();
            Xn.html("Please choose the Prebuild Themes and Layouts, then you can edit modules,color scheme,bg and contents.").css("display", "none").fadeIn(1e3)
        });
        Rt.click(function() {
            Ft.removeClass("active");
            $(this).addClass("active");
            Jt.hide();
            Mn.find(".accordion").hide();
            Nn.show();
            Yt.slideDown();
            Xn.html('Please edit the color scheme, you can pick / input / copy / paste the color value, do not forget the "#".').css("display", "none").fadeIn(1e3)
        });
        Ut.click(function() {
            Ft.removeClass("active");
            $(this).addClass("active");
            Jt.hide();
            _n.find(".accordion").hide();
            Ln.show();
            Zt.slideDown();
            Xn.html("Please edit the BG textures & Bg images & border height & border radius value.").css("display", "none").fadeIn(1e3)
        });
        zt.click(function() {
            Ft.removeClass("active");
            $(this).addClass("active");
            Jt.hide();
            en.slideDown();
            Xn.html("Please input the preheader text and choose which version you want , and then you can download the email page.").css("display", "none").fadeIn(1e3)
        });
        Wt.click(function() {
            Ft.removeClass("active");
            $(this).addClass("active");
            Jt.hide();
            tn.slideDown();
            Xn.html("Copyright info. Many thanks!").css("display", "none").fadeIn(1e3)
        });
        Xt.click(function() {
            Ft.removeClass("active");
            $(this).addClass("active");
            Jt.hide();
            nn.slideDown();
            Xn.html("Please see the guide to learn how to use digith_template_builder.").css("display", "none").fadeIn(1e3)
        });
        Nr.click(function() {
            Ft.removeClass("active");
            $(this).addClass("active");
            Jt.hide();
            Pn.find(".accordion").hide();
            Hn.show();
            Or.slideDown();
            Xn.html("Please see the guide to learn how to use digith_template_builder.").css("display", "none").fadeIn(1e3)
        })
    }

    function _i() {
        if (isRadius == false && isBG == false) {
            Ut.hide()
        }
        if (isDemo == true) {
            ln.show()
        } else {
            ln.hide()
        }
        if (isBG == false) {
            Un.hide()
        } else {
            Un.show()
        }
        if (isRadius == false) {
            zn.hide()
        } else {
            zn.show()
        }
    }

    function Di() {
        pn.click(function() {
            Wn.removeClass("active");
            $(this).addClass("active");
            pS = "-inline";
            pC = "inline CSS version";
            Xn.html("You choose default inline CSS version...").css("display", "none").fadeIn(1e3);
            return false
        });
        dn.click(function() {
            Wn.removeClass("active");
            $(this).addClass("active");
            pS = "-mc";
            pC = "Mailchimp version";
            Xn.html('You choose mailchimp tags integrated version and page tile will set to "*|MC:SUBJECT|*"...').css("display", "none").fadeIn(1e3);
            return false
        });
        vn.click(function() {
            Wn.removeClass("active");
            $(this).addClass("active");
            pS = "-cm";
            pC = "CampaignMonitor version";
            Xn.html("You choose campaignMonitor tags integrated version...").css("display", "none").fadeIn(1e3);
            return false
        })
    }

    function Pi() {
        $(document).tooltip({
            position: {
                predelay: 0,
                my: "center top+5",
                at: "center bottom",
                effect: "toggle",
                opacity: .3,
                using: function(e, t) {
                    $(this).css(e);
                    $("<div>").addClass(t.vertical).addClass(t.horizontal).appendTo(this)
                }
            }
        })
    }

    function Hi(e) {
        var t = [];
        var n;
        while (e.length > 0) {
            n = e[0];
            t.push(n);
            e = $.grep(e, function(e, t) {
                return e == n
            }, true)
        }
        return t
    }

    function Bi(e) {
        e = e.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        return "#" + ("0" + parseInt(e[1], 10).toString(16)).slice(-2) + ("0" + parseInt(e[2], 10).toString(16)).slice(-2) + ("0" + parseInt(e[3], 10).toString(16)).slice(-2)
    }

    function ji(e) {
        var t = [{
                width: 100,
                height: 50,
                padding: 10,
                stepsPerFrame: 2,
                trailLength: 1,
                pointDistance: .03,
                strokeColor: "#E6E8FA",
                step: "fader",
                multiplier: 2,
                setup: function() {
                    this._.lineWidth = 5
                },
                path: [
                    ["arc", 10, 10, 10, -270, -90],
                    ["bezier", 10, 0, 40, 20, 20, 0, 30, 20],
                    ["arc", 40, 10, 10, 90, -90],
                    ["bezier", 40, 0, 10, 20, 30, 0, 20, 20]
                ]
            }];
        var n, r, i = document.getElementById("mask2");
        for (var s = -1, o = t.length; ++s < o; ) {
            n = document.createElement("div");
            n.className = "l";
            r = new Sonic(t[s]);
            n.appendChild(r.canvas);
            i.appendChild(n);
            r.canvas.style.marginTop = (Lt.height() - 74 - r.fullHeight) / 2 + "px";
            r.canvas.style.marginLeft = (Lt.width() - 325 - r.fullWidth) / 2 + "px";
            e ? r.play() : LdO.stop();
            LdO = r
        }
    }

    function Fi() {
        if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.match(/7./i) == "7.") {
            Yn.css({
                display: "inline-block"
            }).show()
        } else if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.match(/8./i) == "8.") {
            Yn.css({
                display: "inline-block"
            }).show()
        } else {
            Yn.hide();
            Gn.css({
                display: "inline-block"
            }).show();
            $("#barrPurchase,#template").css({
                display: "inline-block"
            }).show()
        }
        cr.click(function() {
            if (repk == 0) {
                return false
            }
            $n.css({
                "max-height": "none",
                "border-width": "0px"
            }).animate({
                width: "100%",
                maxHeight: "100%",
                marginBottom: "0"
            }, 400);
            Qn.removeClass("active");
            $(this).addClass("active");
            isMedia = "pc";
            var e = $(CK + " style").html().replace(hMediaNeiStart, "MediaNeiStart");
            $(CK + " style").html(e);
            Xn.html("Normal PC, width 100% to show the Email, if edit content mode do not show toolbar, <span>clik Edit Content button</span>.").fadeIn(1e3);
            Qr();
            return false
        });
        dr.click(function() {
            if (repk == 0) {
                return false
            }
            $n.css({
                "border-width": "0px"
            }).animate({
                width: "320px",
                maxHeight: "100%",
                marginBottom: "0"
            }, 400);
            Qn.removeClass("active");
            $(this).addClass("active");
            isMedia = "m320";
            var e = $(CK + " style").html().replace(hMediaNeiStart, "MediaNeiStart");
            e = e.replace(S640, hS640).replace(S480, hS480).replace(S360, hS360).replace(S320, hS320);
            $(CK + " style").html(e);
            Xn.html("Device: Mobile Phone, width 320px to show the Email, if edit content mode do not show toolbar, <span>clik Edit Content button</span>.").fadeIn(1e3);
            Qr();
            return false
        });
        vr.click(function() {
            if (repk == 0) {
                return false
            }
            $n.css({
                "border-width": "0px"
            }).animate({
                width: "480px",
                maxHeight: "100%",
                marginBottom: "0"
            }, 400);
            Qn.removeClass("active");
            $(this).addClass("active");
            isMedia = "m480";
            var e = $(CK + " style").html().replace(hMediaNeiStart, "MediaNeiStart").replace(S640, hS640).replace(S480, hS480);
            $(CK + " style").html(e);
            Xn.html("Device: Mobile Phone, width 480px to show the Email, if edit content mode do not show toolbar, <span>clik Edit Content button</span>.").fadeIn(1e3);
            Qr();
            return false
        });
        mr.click(function() {
            if (repk == 0) {
                return false
            }
            $n.css({
                "border-width": "0px"
            }).animate({
                width: "360px",
                maxHeight: "100%",
                marginBottom: "0"
            }, 400);
            Qn.removeClass("active");
            $(this).addClass("active");
            isMedia = "m360";
            var e = $(CK + " style").html().replace(hMediaNeiStart, "MediaNeiStart");
            e = e.replace(S640, hS640).replace(S480, hS480).replace(S360, hS360);
            $(CK + " style").html(e);
            Xn.html("Device: Mobile Phone, width 360px to show the Email, if edit content mode do not show toolbar, <span>clik Edit Content button</span>.").fadeIn(1e3);
            Qr();
            return false
        });
        gr.click(function() {
            if (repk == 0) {
                return false
            }
            $n.css({
                "border-width": "0px"
            }).animate({
                width: "640px",
                maxHeight: "100%",
                marginBottom: "0"
            }, 400);
            Qn.removeClass("active");
            $(this).addClass("active");
            isMedia = "m640";
            var e = $(CK + " style").html().replace(hMediaNeiStart, "MediaNeiStart");
            e = e.replace(S640, hS640);
            $(CK + " style").html(e);
            Xn.html("Device: Mobile Phone, width 640px to show the Email, if edit content mode do not show toolbar, <span>clik Edit Content button</span>.").fadeIn(1e3);
            Qr();
            return false
        });
        hr.click(function() {
            if (repk == 0) {
                return false
            }
            $n.css({
                "border-width": "0px"
            }).animate({
                width: "768px",
                maxHeight: "100%",
                marginBottom: "0"
            }, 400);
            Qn.removeClass("active");
            $(this).addClass("active");
            isMedia = "m800";
            var e = $(CK + " style").html().replace(hMediaNeiStart, "MediaNeiStart");
            $(CK + " style").html(e);
            Xn.html("Device: ipad, width 768px to show the Email, if edit content mode do not show toolbar, <span>clik Edit Content button</span>.").fadeIn(1e3);
            Qr();
            return false
        })
    }

    function Ii() {
        var e = /^(rgb|RGB)/;
        var t = /^(rgba|RGBA)/;
        CC1 = $n.find("a").not(".header a,.button a,.footer a,.color-bg a,.dark-bg a").css("color") || Jn.find("a").not(".header a,.button a,.footer a,.color-bg a,.dark-bg a").css("color");
        CC2 = $n.find("body, .BGtable").css("background-color") || Jn.find("body, .BGtable").css("background-color");
        CC3 = $n.find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").css("background-color") || Jn.find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").css("background-color");
        CC4 = $n.find(".wrap.header").css("background-color") || Jn.find(".wrap.header").css("background-color");
        CC5 = $n.find(".wrap.bottom,.wrap.footer").css("background-color") || Jn.find(".wrap.bottom,.wrap.footer").css("background-color");
        CC6 = $n.find(".wrap.gray").css("background-color") || Jn.find(".wrap.gray").css("background-color");
        CC7 = $n.find(".wrap.dark").css("background-color") || Jn.find(".wrap.dark").css("background-color");
        CC8 = $n.find(".bottom-module").css("background-color") || Jn.find(".bottom-module").css("background-color");
        CC9 = $n.find(".header a").css("color") || Jn.find(".header a").css("color");
        CC10 = $n.find(".button a,.color-bg a,.dark-bg a").css("color") || Jn.find(".button a,.color-bg a,.dark-bg a").css("color");
        CC11 = $n.find(".footer a").css("color") || Jn.find(".footer a").css("color");
        CC12 = $n.find("h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6").not(".col3.list .dark-bg.h4,.col3.list .dark-bg .h4,.col2.list .dark-bg.h4,.col2.list .dark-bg .h4,.dark-bg.h4,.col4.list .bg1.h4,.headerbanner .h1,.headerbanner .h2,.banner1 .h5,.wrap.dark .h3,.wrap.dark .h4,.wrap.bottom .h2.large,.wrap.bottom .h5,.banner2 .h3,.banner2 .h2,.banner2 .h4,.banner3 .h2,.banner3 .h3,.banner4 .h2,.banner4 .h3,.banner5 .h2,.banner5 .h3,.wrap.color .title-module .h3,.wrap.color .title-module .h2,.highlight,.footer .h6").css("color") || Jn.find("h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6").not(".col3.list .dark-bg.h4,.col3.list .dark-bg .h4,.col2.list .dark-bg.h4,.col2.list .dark-bg .h4,.dark-bg.h4,.col4.list .bg1.h4,.headerbanner .h1,.headerbanner .h2,.banner1 .h5,.wrap.dark .h3,.wrap.dark .h4,.wrap.bottom .h2.large,.wrap.bottom .h5,.banner2 .h3,.banner2 .h2,.banner2 .h4,.banner3 .h2,.banner3 .h3,.banner4 .h2,.banner4 .h3,.banner5 .h2,.banner5 .h3,.wrap.color .title-module .h3,.wrap.color .title-module .h2,.highlight,.footer .h6").css("color");
        CC13 = $n.find(".content,.content p").not(".headerbanner .content,.banner1 .content,.wrap.bottom .content,.dark-bg.content,.banner2 .content,.banner3 .content,.banner4 .content,.color-bg.content,.banner5 .content,.banner5 .content p,.highlight").css("color") || Jn.find(".content,.content p").not(".headerbanner .content,.banner1 .content,.wrap.bottom .content,.dark-bg.content,.banner2 .content,.banner3 .content,.banner4 .content,.color-bg.content,.banner5 .content,.banner5 .content p,.highlight").css("color");
        CC14 = $n.find(".headerbanner .content,.headerbanner .h1,.headerbanner .h2").css("color") || Jn.find(".headerbanner .content,.headerbanner .h1,.headerbanner .h2").css("color");
        CC15 = $n.find(".banner1 .content,.banner2 .content,.banner3 .content,.banner4 .content,.banner5 .content,.banner5 .content p,.banner1 .h5,.banner2 .h3,.banner2 .h2,.banner2 .h4,.banner3 .h2,.banner3 .h3,.banner4 .h2,.banner4 .h3,.banner5 .h2,.banner5 .h3").not(".banner4 .drak-bg.content,.banner2 .color-bg.content").css("color") || Jn.find(".banner1 .content,.banner2 .content,.banner3 .content,.banner4 .content,.banner5 .content,.banner5 .content p,.banner1 .h5,.banner2 .h3,.banner2 .h2,.banner2 .h4,.banner3 .h2,.banner3 .h3,.banner4 .h2,.banner4 .h3,.banner5 .h2,.banner5 .h3").not(".banner4 .drak-bg.content,.banner2 .color-bg.content").css("color");
        CC16 = $n.find(".wrap.dark .h3,.wrap.dark .h4,.dark-bg.content,.col3.list .dark-bg.h4,.col3.list .dark-bg .h4,.col2.list .dark-bg.h4,.col2.list .dark-bg .h4,.dark-bg.h4,.col4.list .bg1.h4").css("color") || Jn.find(".wrap.dark .h3,.wrap.dark .h4,.dark-bg.content,.col3.list .dark-bg.h4,.col3.list .dark-bg .h4,.col2.list .dark-bg.h4,.col2.list .dark-bg .h4,.dark-bg.h4,.col4.list .bg1.h4").css("color");
        CC17 = $n.find(".wrap.bottom .h2.large,.wrap.bottom .h5,.wrap.bottom .content").css("color") || Jn.find(".wrap.bottom .h2.large,.wrap.bottom .h5,.wrap.bottom .content").css("color");
        CC18 = $n.find(".headerbanner1,.headerbanner2,.headerbanner3,.banner1,.banner2,.banner3,.banner4,.banner5,.banner6").css("background-color") || Jn.find(".headerbanner1,.headerbanner2,.headerbanner3,.banner1,.banner2,.banner3,.banner4,.banner5,.banner6").css("background-color");
        mC1 = CC1 = e.test(CC1) && Bi(CC1) || CC1;
        mC2 = CC2 = e.test(CC2) && Bi(CC2) || CC2;
        mC3 = CC3 = e.test(CC3) && Bi(CC3) || CC3;
        mC4 = CC4 = e.test(CC4) && Bi(CC4) || CC4;
        mC5 = CC5 = e.test(CC5) && Bi(CC5) || CC5;
        mC6 = CC6 = e.test(CC6) && Bi(CC6) || CC6;
        mC7 = CC7 = e.test(CC7) && Bi(CC7) || CC7;
        mC8 = CC8 = e.test(CC8) && Bi(CC8) || CC8;
        mC9 = CC9 = e.test(CC9) && Bi(CC9) || CC9;
        mC10 = CC10 = e.test(CC10) && Bi(CC10) || CC10;
        mC11 = CC11 = e.test(CC11) && Bi(CC11) || CC11;
        mC12 = CC12 = e.test(CC12) && Bi(CC12) || CC12;
        mC13 = CC13 = e.test(CC13) && Bi(CC13) || CC13;
        mC14 = CC14 = e.test(CC14) && Bi(CC14) || CC14;
        mC15 = CC15 = e.test(CC15) && Bi(CC15) || CC15;
        mC16 = CC16 = e.test(CC16) && Bi(CC16) || CC16;
        mC17 = CC17 = e.test(CC17) && Bi(CC17) || CC17;
        mC18 = CC18 = e.test(CC18) && Bi(CC18) || CC18;
        qi();
        zi();
        if (isBG == true) {
            V.val(BgImgUrl1 = $n.find("	.headerbanner1	").attr("background") || Jn.find("	.headerbanner1	").attr("background"));
            J.val(BgImgUrl2 = $n.find("	.headerbanner2	").attr("background") || Jn.find("	.headerbanner2	").attr("background"));
            K.val(BgImgUrl3 = $n.find("	.headerbanner3  ").attr("background") || Jn.find("	.headerbanner3  ").attr("background"));
            Q.val(BgImgUrl4 = $n.find("	.banner1  ").attr("background") || Jn.find("	.banner1  ").attr("background"));
            G.val(BgImgUrl5 = $n.find("	.banner2  ").attr("background") || Jn.find("	.banner2  ").attr("background"));
            Y.val(BgImgUrl6 = $n.find("	.banner3  ").attr("background") || Jn.find("	.banner3  ").attr("background"));
            Z.val(BgImgUrl7 = $n.find("	.banner4  ").attr("background") || Jn.find("	.banner4  ").attr("background"));
            et.val(BgImgUrl8 = $n.find("	.banner5  ").attr("background") || Jn.find("	.banner5  ").attr("background"));
            tt.val(BgImgUrl9 = $n.find("	.banner6  ").attr("background") || Jn.find("	.banner6  ").attr("background"));
            if (BgImgUrl1 == undefined) {
                Jn.find(".headerbanner1").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".headerbanner1").attr("background", BgImgUrl1).css({
                    "background-image": "url(" + BgImgUrl1 + ")"
                })
            }
            if (BgImgUrl2 == undefined) {
                Jn.find(".headerbanner2").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".headerbanner2").attr("background", BgImgUrl2).css({
                    "background-image": "url(" + BgImgUrl2 + ")"
                })
            }
            if (BgImgUrl3 == undefined) {
                Jn.find(".headerbanner3").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".headerbanner3").attr("background", BgImgUrl3).css({
                    "background-image": "url(" + BgImgUrl3 + ")"
                })
            }
            if (BgImgUrl4 == undefined) {
                Jn.find(".banner1").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".banner1").attr("background", BgImgUrl4).css({
                    "background-image": "url(" + BgImgUrl4 + ")"
                })
            }
            if (BgImgUrl5 == undefined) {
                Jn.find(".banner2").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".banner2").attr("background", BgImgUrl5).css({
                    "background-image": "url(" + BgImgUrl5 + ")"
                })
            }
            if (BgImgUrl6 == undefined) {
                Jn.find(".banner3").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".banner3").attr("background", BgImgUrl6).css({
                    "background-image": "url(" + BgImgUrl6 + ")"
                })
            }
            if (BgImgUrl7 == undefined) {
                Jn.find(".banner4").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".banner4").attr("background", BgImgUrl7).css({
                    "background-image": "url(" + BgImgUrl7 + ")"
                })
            }
            if (BgImgUrl8 == undefined) {
                Jn.find(".banner5").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".banner5").attr("background", BgImgUrl8).css({
                    "background-image": "url(" + BgImgUrl8 + ")"
                })
            }
            if (BgImgUrl9 == undefined) {
                Jn.find(".banner6").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".banner6").attr("background", BgImgUrl9).css({
                    "background-image": "url(" + BgImgUrl9 + ")"
                })
            }
            var n = $n.find(".BGtable").attr("background");
            var r = $n.find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").attr("background");
            var i = $n.find(".wrap.gray").attr("background");
            var s = $n.find(".wrap.header").attr("background");
            var o = $n.find(".wrap.bottom,.wrap.footer").attr("background");
            if (n == undefined) {
                Jn.find(".BGtable").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".BGtable").attr("background", n).css({
                    "background-image": "url(" + n + ")"
                })
            }
            if (r == undefined) {
                Jn.find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").attr("background", r).css({
                    "background-image": "url(" + r + ")"
                })
            }
            if (i == undefined) {
                Jn.find(".wrap.gray").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".wrap.gray").attr("background", i).css({
                    "background-image": "url(" + i + ")"
                })
            }
            if (s == undefined) {
                Jn.find(".wrap.header").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".wrap.header").attr("background", s).css({
                    "background-image": "url(" + s + ")"
                })
            }
            if (o == undefined) {
                Jn.find(".wrap.bottom,.wrap.footer").removeAttr("background").css({
                    "background-image": "none"
                })
            } else {
                Jn.find(".wrap.bottom,.wrap.footer").attr("background", o).css({
                    "background-image": "url(" + o + ")"
                })
            }
        }
        if (isRadius == true) {
            Radius1 = $n.find("h1,.h1").not(".headerbanner2 .h1.b").css("font-size") || Jn.find("h1,.h1").not(".headerbanner2 .h1.b").css("font-size");
            rR1 = Radius1 = Radius1.replace(/px/, "");
            St.slider({
                value: Radius1
            });
            mt.val(Radius1 + "px");
            Radius2 = $n.find(".headerbanner2 .h1.b").css("font-size") || Jn.find(".headerbanner2 .h1.b").css("font-size");
            rR2 = Radius2 = Radius2.replace(/px/, "");
            xt.slider({
                value: Radius2
            });
            gt.val(Radius2 + "px");
            Radius3 = $n.find("h2,.h2").not(".bottom .h2.large").css("font-size") || Jn.find("h2,.h2").not(".bottom .h2.large").css("font-size");
            rR3 = Radius3 = Radius3.replace(/px/, "");
            Tt.slider({
                value: Radius3
            });
            yt.val(Radius3 + "px");
            Radius4 = $n.find("h3,.h3").css("font-size") || Jn.find("h3,.h3").css("font-size");
            rR4 = Radius4 = Radius4.replace(/px/, "");
            Nt.slider({
                value: Radius4
            });
            bt.val(Radius4 + "px");
            Radius5 = $n.find(".footer .h6").css("font-size") || Jn.find(".footer .h6").css("font-size");
            rR5 = Radius5 = Radius5.replace(/px/, "");
            Ct.slider({
                value: Radius5
            });
            wt.val(Radius5 + "px");
            Radius6 = $n.find(".content, .content p").not(".button .content,.headerbanner .content,.number-td.content,.content.f35").css("font-size") || Jn.find(".content, .content p").not(".button .content,.headerbanner .content,.number-td.content,.content.f35").css("font-size");
            rR6 = Radius6 = Radius6.replace(/px/, "");
            kt.slider({
                value: Radius6
            });
            Et.val(Radius6 + "px");
            Jn.find("h1,.h1").not(".headerbanner2 .h1.b").css({
                "font-size": Radius1 + "px"
            });
            Jn.find(".headerbanner2 .h1.b").css({
                "font-size": Radius2 + "px"
            });
            Jn.find("h2,.h2").not(".bottom .h2.large").css({
                "font-size": Radius3 + "px"
            });
            Jn.find("h3,.h3").css({
                "font-size": Radius4 + "px"
            });
            Jn.find("h6,.h6").css({
                "font-size": Radius5 + "px"
            });
            Jn.find(".content, .content p").not(".button .content,.headerbanner .content,.number-td.content,.content.f35").css({
                "font-size": Radius6 + "px"
            })
        }
    }

    function qi() {
        var e = ", .btn.b .in.l a, .price-table.hover .price-td3 td, .price-table.hover .price-td3 span";
        var t = ", .price-table.hover .borderbg";
        var n = ", .button.hover, .ring.hover, .price-table.hover .price-td1, .price-table.hover .borderbg";
        Jn.find("a").not(".header a,.button a,.footer a,.color-bg a,.dark-bg a").css("color", CC1);
        Jn.find(".highlight,.btn a,.headerbanner3 .button a").not(".wrap.color .title-module .highlight,.banner2 .title-module .highlight,.banner3 .title-module .highlight,.banner4 .title-module .highlight,.banner5 .title-module .highlight").css("color", CC1);
        Jn.find(".wrap.color,.color-bg,.skill-bar.l,.button .content").not(".headerbanner3 .button .content").css("background-color", CC1);
        Jn.find(".underline").not(".headerbanner1 .underline,.headerbanner2 .underline,.wrap.color .underline,.banner2 .underline,.banner3 .underline,.banner4 .underline,.banner5 .underline,.bottom .col2.r .underline,.col3.list .underline,.col2.list .underline").css("border-bottom-color", CC1);
        Jn.find(".skill-bar,.btn .content").css("border-color", CC1);
        Jn.find("body, .BGtable").css("background-color", CC2);
        Jn.find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").css("background-color", CC3);
        Jn.find(".wrap.header").css("background-color", CC4);
        Jn.find(".wrap.bottom,.wrap.footer").css("background-color", CC5);
        Jn.find(".wrap.gray").css("background-color", CC6);
        Jn.find(".wrap.dark").css("background-color", CC7);
        Jn.find(".bottom-module").css("background-color", CC8);
        Jn.find(".header a").css("color", CC9);
        Jn.find(".button a,.color-bg a,.dark-bg a").css("color", CC10);
        Jn.find(".footer a").css("color", CC11);
        Jn.find(".footer .h6").css("color", CC11);
        Jn.find("h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6").not(".col3.list .dark-bg.h4,.col3.list .dark-bg .h4,.col2.list .dark-bg.h4,.col2.list .dark-bg .h4,.dark-bg.h4,.col4.list .bg1.h4,.headerbanner .h1,.headerbanner .h2,.banner1 .h5,.wrap.dark .h3,.wrap.dark .h4,.wrap.bottom .h2.large,.wrap.bottom .h5,.banner2 .h3,.banner2 .h2,.banner2 .h4,.banner3 .h2,.banner3 .h3,.banner4 .h2,.banner4 .h3,.banner5 .h2,.banner5 .h3,.wrap.color .title-module .h3,.wrap.color .title-module .h2,.highlight,.footer .h6").css("color", CC12);
        Jn.find(".content,.content p").not(".headerbanner .content,.banner1 .content,.wrap.bottom .content,.dark-bg.content,.banner2 .content,.banner3 .content,.banner4 .content,.color-bg.content,.banner5 .content,.banner5 .content p,.highlight").css("color", CC13);
        Jn.find(".headerbanner .content,.headerbanner .h1,.headerbanner .h2,.headerbanner1 .button a,.headerbanner2 .color-bg a").css("color", CC14);
        Jn.find(".headerbanner1 .underline,.headerbanner3 .button .content,.headerbanner2 .underline").css("border-bottom-color", CC14);
        Jn.find(".headerbanner3 .button .content,.headerbanner3 .line,.headerbanner2 .line").css("background-color", CC14);
        Jn.find(".banner1 .content,.banner2 .content,.banner3 .content,.banner4 .content,.banner5 .content,.banner5 .content p,.banner1 .h5,.banner2 .h3,.banner2 .h2,.banner2 .h4,.banner3 .h2,.banner3 .h3,.banner4 .h2,.banner4 .h3,.banner5 .h2,.banner5 .h3").not(".banner4 .drak-bg.content,.banner2 .color-bg.content").css("color", CC15);
        Jn.find(".banner2 .underline,.banner3 .underline,.banner4 .underline,.banner5 .underline").css("border-bottom-color", CC15);
        Jn.find(".banner .icon-td").css("border-color", CC15);
        Jn.find(".wrap.dark .h3,.wrap.dark .h4,.dark-bg.content,.col3.list .dark-bg.h4,.col3.list .dark-bg .h4,.col2.list .dark-bg.h4,.col2.list .dark-bg .h4,.dark-bg.h4,.col4.list .bg1.h4").css("color", CC16);
        Jn.find(".wrap.bottom .h2.large,.wrap.bottom .h5,.wrap.bottom .content").css("color", CC17);
        Jn.find(".headerbanner1,.headerbanner2,.headerbanner3,.banner1,.banner2,.banner3,.banner4,.banner5,.banner6,.headerbanner1-bg").css("background-color", CC18)
    }

    function Ri() {
        var e = $(CK).find(".header-img").css("background-color");
        $(CK).find(".divider .wrap").removeClass("mediahide");
        $(CK).find(".header-img").parent().parent().parent().prev("div").find(".divider .wrap").addClass("mediahide").css("background-color", e);
        $(CK).find(".header-img").parent().parent().parent().next("div").find(".divider .row1").addClass("mediahide").css("background-color", e)
    }

    function Ui() {
        t.val(CC1);
        n.val(CC2);
        r.val(CC3);
        s.val(CC4);
        o.val(CC5);
        u.val(CC6);
        f.val(CC7);
        l.val(CC8);
        p.val(CC9);
        v.val(CC10);
        m.val(CC11);
        y.val(CC12);
        w.val(CC13);
        E.val(CC14);
        S.val(CC15);
        x.val(CC16);
        T.val(CC17);
        N.val(CC18);
        C.farbtastic(C1S);
        L.farbtastic(C2S);
        A.farbtastic(C3S);
        O.farbtastic(C4S);
        M.farbtastic(C5S);
        _.farbtastic(C6S);
        D.farbtastic(C7S);
        P.farbtastic(C8S);
        H.farbtastic(C9S);
        B.farbtastic(C10S);
        F.farbtastic(C11S);
        I.farbtastic(C12S);
        q.farbtastic(C13S);
        R.farbtastic(C14S);
        U.farbtastic(C15S);
        z.farbtastic(C16S);
        W.farbtastic(C17S);
        X.farbtastic(C18S)
    }

    function zi() {
        t.val(CC1);
        n.val(CC2);
        r.val(CC3);
        s.val(CC4);
        o.val(CC5);
        u.val(CC6);
        f.val(CC7);
        l.val(CC8);
        p.val(CC9);
        v.val(CC10);
        m.val(CC11);
        y.val(CC12);
        w.val(CC13);
        E.val(CC14);
        S.val(CC15);
        x.val(CC16);
        T.val(CC17);
        N.val(CC18);
        mi(C, t);
        mi(L, n);
        mi(A, r);
        mi(O, s);
        mi(M, o);
        mi(_, u);
        mi(D, f);
        mi(P, l);
        mi(H, p);
        mi(B, v);
        mi(F, m);
        mi(I, y);
        mi(q, w);
        mi(R, E);
        mi(U, S);
        mi(z, x);
        mi(W, T);
        mi(X, N)
    }

    function Wi() {
        ct.find("li.patternItem").click(function() {
            var e = $(this).attr("id");
            var t = IPmL + e;
            var n = "url(" + t + ")";
            ct.find("li.patternItem").removeClass("active");
            $(this).addClass("active");
            if (e == "none.png") {
                $n.find(".BGtable").attr("background", "").css({
                    "background-image": "none"
                });
                Jn.find(".BGtable").attr("background", "").css({
                    "background-image": "none"
                })
            } else {
                $n.find(".BGtable").attr("background", t).css({
                    "background-image": n
                });
                Jn.find(".BGtable").attr("background", t).css({
                    "background-image": n
                })
            }
        });
        ht.find("li.patternItem").click(function() {
            var e = $(this).attr("id");
            var t = IPmL + e;
            var n = "url(" + t + ")";
            ht.find("li.patternItem").removeClass("active");
            $(this).addClass("active");
            if (e == "none.png") {
                $n.find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").attr("background", "").css({
                    "background-image": "none"
                });
                Jn.find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").css({
                    "background-image": "none"
                })
            } else {
                $n.find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").attr("background", t).css({
                    "background-image": n
                });
                Jn.find(".wrap").not(".wrap.gray,.wrap.dark,.wrap.color,.wrap.header,.wrap.bottom,.wrap.footer").attr("background", t).css({
                    "background-image": n
                })
            }
        });
        pt.find("li.patternItem").click(function() {
            var e = $(this).attr("id");
            var t = IPmL + e;
            var n = "url(" + t + ")";
            pt.find("li.patternItem").removeClass("active");
            $(this).addClass("active");
            if (e == "none.png") {
                $n.find(".wrap.gray").attr("background", "").css({
                    "background-image": "none"
                });
                Jn.find(".wrap.gray").attr("background", "").css({
                    "background-image": "none"
                })
            } else {
                $n.find(".wrap.gray").attr("background", t).css({
                    "background-image": n
                });
                Jn.find(".wrap.gray").attr("background", t).css({
                    "background-image": n
                })
            }
        });
        dt.find("li.patternItem").click(function() {
            var e = $(this).attr("id");
            var t = IPmL + e;
            var n = "url(" + t + ")";
            dt.find("li.patternItem").removeClass("active");
            $(this).addClass("active");
            if (e == "none.png") {
                $n.find(".wrap.header").attr("background", "").css({
                    "background-image": "none"
                });
                Jn.find(".wrap.header").attr("background", "").css({
                    "background-image": "none"
                })
            } else {
                $n.find(".wrap.header").attr("background", t).css({
                    "background-image": n
                });
                Jn.find(".wrap.header").attr("background", t).css({
                    "background-image": n
                })
            }
        });
        vt.find("li.patternItem").click(function() {
            var e = $(this).attr("id");
            var t = IPmL + e;
            var n = "url(" + t + ")";
            vt.find("li.patternItem").removeClass("active");
            $(this).addClass("active");
            if (e == "none.png") {
                $n.find(".wrap.bottom,.wrap.footer").attr("background", "").css({
                    "background-image": "none"
                });
                Jn.find(".wrap.bottom,.wrap.footer").attr("background", "").css({
                    "background-image": "none"
                })
            } else {
                $n.find(".wrap.bottom,.wrap.footer").attr("background", t).css({
                    "background-image": n
                });
                Jn.find(".wrap.bottom,.wrap.footer").attr("background", t).css({
                    "background-image": n
                })
            }
        });
        nt.click(function() {
            if (isBG == false) {
                return false
            } else {
                BgChange1 = V.val();
                if (BgChange1 != BgImgUrl1) {
                    $n.find(".headerbanner1").attr("background", BgChange1).css({
                        "background-image": "url(" + BgChange1 + ")"
                    });
                    Jn.find(".headerbanner1").attr("background", BgChange1).css({
                        "background-image": "url(" + BgChange1 + ")"
                    });
                    BgImgUrl1 = BgChange1
                }
            }
        });
        rt.click(function() {
            if (isBG == false) {
                return false
            } else {
                BgChange2 = J.val();
                if (BgChange2 != BgImgUrl2) {
                    $n.find(".headerbanner2").attr("background", BgChange2).css({
                        "background-image": "url(" + BgChange2 + ")"
                    });
                    Jn.find(".headerbanner2").attr("background", BgChange2).css({
                        "background-image": "url(" + BgChange2 + ")"
                    });
                    BgImgUrl2 = BgChange2
                }
            }
        });
        it.click(function() {
            if (isBG == false) {
                return false
            } else {
                BgChange3 = K.val();
                if (BgChange3 != BgImgUrl3) {
                    $n.find(".headerbanner3").attr("background", BgChange3).css({
                        "background-image": "url(" + BgChange3 + ")"
                    });
                    Jn.find(".headerbanner3").attr("background", BgChange3).css({
                        "background-image": "url(" + BgChange3 + ")"
                    });
                    BgImgUrl3 = BgChange3
                }
            }
        });
        st.click(function() {
            if (isBG == false) {
                return false
            } else {
                BgChange4 = Q.val();
                if (BgChange4 != BgImgUrl4) {
                    $n.find(".banner1").attr("background", BgChange4).css({
                        "background-image": "url(" + BgChange4 + ")"
                    });
                    Jn.find(".banner1").attr("background", BgChange4).css({
                        "background-image": "url(" + BgChange4 + ")"
                    });
                    BgImgUrl4 = BgChange4
                }
            }
        });
        ot.click(function() {
            if (isBG == false) {
                return false
            } else {
                BgChange5 = G.val();
                if (BgChange5 != BgImgUrl5) {
                    $n.find(".banner2").attr("background", BgChange5).css({
                        "background-image": "url(" + BgChange5 + ")"
                    });
                    Jn.find(".banner2").attr("background", BgChange5).css({
                        "background-image": "url(" + BgChange5 + ")"
                    });
                    BgImgUrl5 = BgChange5
                }
            }
        });
        ut.click(function() {
            if (isBG == false) {
                return false
            } else {
                BgChange6 = Y.val();
                if (BgChange6 != BgImgUrl6) {
                    $n.find(".banner3").attr("background", BgChange6).css({
                        "background-image": "url(" + BgChange6 + ")"
                    });
                    Jn.find(".banner3").attr("background", BgChange6).css({
                        "background-image": "url(" + BgChange6 + ")"
                    });
                    BgImgUrl6 = BgChange6
                }
            }
        });
        at.click(function() {
            if (isBG == false) {
                return false
            } else {
                BgChange7 = Z.val();
                if (BgChange7 != BgImgUrl7) {
                    $n.find(".banner4").attr("background", BgChange7).css({
                        "background-image": "url(" + BgChange7 + ")"
                    });
                    Jn.find(".banner4").attr("background", BgChange7).css({
                        "background-image": "url(" + BgChange7 + ")"
                    });
                    BgImgUrl7 = BgChange7
                }
            }
        });
        ft.click(function() {
            if (isBG == false) {
                return false
            } else {
                BgChange8 = et.val();
                if (BgChange8 != BgImgUrl8) {
                    $n.find(".banner5").attr("background", BgChange8).css({
                        "background-image": "url(" + BgChange8 + ")"
                    });
                    Jn.find(".banner5").attr("background", BgChange8).css({
                        "background-image": "url(" + BgChange8 + ")"
                    });
                    BgImgUrl8 = BgChange8
                }
            }
        });
        lt.click(function() {
            if (isBG == false) {
                return false
            } else {
                BgChange9 = tt.val();
                if (BgChange9 != BgImgUrl9) {
                    $n.find(".banner6").attr("background", BgChange9).css({
                        "background-image": "url(" + BgChange9 + ")"
                    });
                    Jn.find(".banner6").attr("background", BgChange9).css({
                        "background-image": "url(" + BgChange9 + ")"
                    });
                    BgImgUrl9 = BgChange9
                }
            }
        })
    }

    function Xi() {
        St.slider({
            range: "min",
            value: Radius1,
            min: 30,
            max: 60,
            slide: function(e, t) {
                rR1 = t.value;
                mt.val(t.value + "px");
                $n.find("h1,.h1").not(".headerbanner2 .h1.b").css({
                    "font-size": t.value + "px"
                });
                Jn.find("h1,.h1").not(".headerbanner2 .h1.b").css({
                    "font-size": t.value + "px"
                })
            }
        });
        mt.val(St.slider("value") + "px");
        xt.slider({
            range: "min",
            value: Radius2,
            min: 30,
            max: 60,
            slide: function(e, t) {
                rR2 = t.value;
                gt.val(t.value + "px");
                $n.find(".headerbanner2 .h1.b").css({
                    "font-size": t.value + "px"
                });
                Jn.find(".headerbanner2 .h1.b").css({
                    "font-size": t.value + "px"
                })
            }
        });
        gt.val(xt.slider("value") + "px");
        Tt.slider({
            range: "min",
            value: Radius3,
            min: 20,
            max: 36,
            slide: function(e, t) {
                rR3 = t.value;
                yt.val(t.value + "px");
                $n.find("h2,.h2").not(".bottom .h2.large").css({
                    "font-size": t.value + "px"
                });
                Jn.find("h2,.h2").not(".bottom .h2.large").css({
                    "font-size": t.value + "px"
                })
            }
        });
        yt.val(Tt.slider("value") + "px");
        Nt.slider({
            range: "min",
            value: Radius4,
            min: 16,
            max: 28,
            slide: function(e, t) {
                rR4 = t.value;
                bt.val(t.value + "px");
                $n.find("h3,.h3").css({
                    "font-size": t.value + "px"
                });
                Jn.find("h3,.h3").css({
                    "font-size": t.value + "px"
                })
            }
        });
        bt.val(Nt.slider("value") + "px");
        Ct.slider({
            range: "min",
            value: Radius5,
            min: 10,
            max: 14,
            slide: function(e, t) {
                rR5 = t.value;
                wt.val(t.value + "px");
                $n.find(".footer .h6").css({
                    "font-size": t.value + "px"
                });
                Jn.find(".footer .h6").css({
                    "font-size": t.value + "px"
                })
            }
        });
        wt.val(Ct.slider("value") + "px");
        kt.slider({
            range: "min",
            value: Radius6,
            min: 12,
            max: 16,
            slide: function(e, t) {
                rR6 = t.value;
                Et.val(t.value + "px");
                $n.find(".content, .content p").not(".button .content,.headerbanner .content,.number-td.content,.content.f35").css({
                    "font-size": t.value + "px"
                });
                Jn.find(".content, .content p").not(".button .content,.headerbanner .content,.number-td.content,.content.f35").css({
                    "font-size": t.value + "px"
                })
            }
        })
    }

    function Vi() {
        var e = tCKDM;
        var t = "\r\n";
        var n = ["<html", "</html>", "</head>", "<title", "</title>", "<meta", "<link", "<style", "</style>", "</body>"];
        for (i = 0; i < n.length; ++i) {
            var r = n[i];
            e = e.replace(new RegExp(r, "gi"), t + r)
        }
        var s = ["</div>", "</span>", "</form>", "</fieldset>", "<br>", "<br />", "<hr", "<pre", "</pre>", "<blockquote", "</blockquote>", "<ul", "</ul>", "<ol", "</ol>", "<li", "<dl", "</dl>", "<dt", "</dt>", "<dd", "</dd>", "<!--", "<table", "</table>", "<caption", "</caption>", "<th", "</th>", "<tr", "</tr>", "<td", "</td>", "<script", "</script>", "<noscript", "</noscript>"];
        for (i = 0; i < s.length; ++i) {
            var o = s[i];
            e = e.replace(new RegExp(o, "gi"), t + o)
        }
        var u = ["<label", "</label>", "<legend", "</legend>", "<object", "</object>", "<embed", "</embed>", "<select", "</select>", "<option", "<option", "<input", "<textarea", "</textarea>"];
        for (i = 0; i < u.length; ++i) {
            var a = u[i];
            e = e.replace(new RegExp(a, "gi"), t + a)
        }
        var f = ["<body", "<head", "<div", "<span", "<p", "<form", "<fieldset"];
        for (i = 0; i < f.length; ++i) {
            var l = f[i];
            e = e.replace(new RegExp(l, "gi"), t + t + l)
        }
        tCKDM = e
    }
    var t = $("#color1"),
            n = $("#color2"),
            r = $("#color3"),
            s = $("#color4"),
            o = $("#color5"),
            u = $("#color6"),
            f = $("#color7"),
            l = $("#color8"),
            p = $("#color9"),
            v = $("#color10"),
            m = $("#color11"),
            y = $("#color12"),
            w = $("#color13"),
            E = $("#color14"),
            S = $("#color15"),
            x = $("#color16"),
            T = $("#color17"),
            N = $("#color18"),
            C = $("#picker1"),
            L = $("#picker2"),
            A = $("#picker3"),
            O = $("#picker4"),
            M = $("#picker5"),
            _ = $("#picker6"),
            D = $("#picker7"),
            P = $("#picker8"),
            H = $("#picker9"),
            B = $("#picker10"),
            F = $("#picker11"),
            I = $("#picker12"),
            q = $("#picker13"),
            R = $("#picker14"),
            U = $("#picker15"),
            z = $("#picker16"),
            W = $("#picker17"),
            X = $("#picker18"),
            V = $("#BG1"),
            J = $("#BG2"),
            K = $("#BG3"),
            Q = $("#BG4"),
            G = $("#BG5"),
            Y = $("#BG6"),
            Z = $("#BG7"),
            et = $("#BG8"),
            tt = $("#BG9"),
            nt = $("#ChangeBGnow1"),
            rt = $("#ChangeBGnow2"),
            it = $("#ChangeBGnow3"),
            st = $("#ChangeBGnow4"),
            ot = $("#ChangeBGnow5"),
            ut = $("#ChangeBGnow6"),
            at = $("#ChangeBGnow7"),
            ft = $("#ChangeBGnow8"),
            lt = $("#ChangeBGnow9"),
            ct = $("#pattern1"),
            ht = $("#pattern2"),
            pt = $("#pattern3"),
            dt = $("#pattern4"),
            vt = $("#pattern5"),
            mt = $("#amount1"),
            gt = $("#amount2"),
            yt = $("#amount3"),
            bt = $("#amount4"),
            wt = $("#amount5"),
            Et = $("#amount6"),
            St = $("#slider-range-min1"),
            xt = $("#slider-range-min2"),
            Tt = $("#slider-range-min3"),
            Nt = $("#slider-range-min4"),
            Ct = $("#slider-range-min5"),
            kt = $("#slider-range-min6"),
            Lt = $(window),
            At = $("#builder"),
            Ot = $("#lightt"),
            Mt = $("#darkk"),
            _t = $("#mask"),
            Dt = $("#mask1"),
            Pt = $("#mask2"),
            Ht = $("#top-barr"),
            Bt = $("#gongNeng"),
            jt = $("#pageBox"),
            Ft = $("#top-barr .menuu"),
            It = $("#barrSwithcher"),
            qt = $("#choose-module"),
            Rt = $("#setting-color"),
            Ut = $("#barrBgChang"),
            zt = $("#barrDownload"),
            Wt = $("#barrCopyRight"),
            Xt = $("#barrGuide"),
            Vt = $("#projectVersion"),
            $t = $("#gongNengBox"),
            Jt = $("#gongNengBox .gnn"),
            Kt = $("#gongNengBox .gnn"),
            Qt = $("#switcher_box"),
            Gt = $("#choose-module-box"),
            Yt = $("#color-setting-box"),
            Zt = $("#bg-radius-box"),
            en = $("#download-box"),
            tn = $("#builder-info"),
            nn = $("#guide-box"),
            rn = $("#copyright"),
            sn = $("#patternTitle"),
            on = $("#urlTitle"),
            un = $("#border-setting"),
            an = $("#file-name"),
            fn = $("#preheader"),
            ln = $("li#purchase"),
            cn = $("#code-in"),
            hn = $("#embededCSS"),
            pn = $("#inlineCSS"),
            dn = $("#mailchimp"),
            vn = $("#campaignmonitor"),
            mn = $("li#bbColor"),
            gn = $("li#ttColor"),
            yn = $("li#fsColor"),
            bn = $("li#urlC"),
            wn = $("li#patternC"),
            En = $("li#radiusC"),
            Sn = $("#seeGuide"),
            xn = $("#guideInfo"),
            Tn = $("#accordion-module"),
            Nn = $("#accordion-bg"),
            Cn = $("#accordion-title"),
            kn = $("#accordion-fonts"),
            Ln = $("#accordion-pattern"),
            An = $("#accordion-url"),
            On = $("#accordion-radius"),
            Mn = $("#dakuo-color"),
            _n = $("#dakuo-BG-Radius"),
            Dn = $("#accordion-guide"),
            Pn = $("#dakuo-google-fonts-api"),
            Hn = $("#accordion-api"),
            Bn = $("#accordion-family"),
            jn = $("#accordion-font-size"),
            Fn = $("li.item"),
            In = $("#download-btn"),
            qn = $("#layout_switcher"),
            Rn = $("#theme_switcher"),
            Un = $("#patternTitle,#urlTitle,#accordion-pattern,#accordion-url"),
            zn = $("#border-setting,#accordion-radius"),
            Wn = $("#code-in .gnn_content"),
            Xn = $("#info-content"),
            Vn = $("#template-page-box"),
            $n = $("#iframe"),
            Jn = $("#hide-iframe"),
            Kn = $("#template-list"),
            Qn = $("#device-list li a"),
            Gn = $("#show-device"),
            Yn = $("#browser"),
            Zn = $("#temp-iframe"),
            er = $("#template"),
            tr = $("#editLayoutButton"),
            nr = $("#editContentButton"),
            rr = $("#uploadProject"),
            ir = $("#uploadFilebox"),
            sr = $("#project-name"),
            or = $("#saveProjectbox"),
            ur = $("#saveProject"),
            ar = $(".center ul li #container"),
            fr = $("#container ul li"),
            lr = $("li#purchase a"),
            cr = $("ol a.pc"),
            hr = $("ol a.ipad"),
            pr = $("ol a.ipad-landscape"),
            dr = $("ol a.iphone"),
            vr = $("ol a.iphone-landscape"),
            mr = $("ol a.mobile-360"),
            gr = $("ol a.mobile-360-landscape"),
            yr = $("#upload ul"),
            br = [],
            wr = [],
            Er, Sr, xr;
    var Tr = $("#accordion-family div.in"),
            Nr = $("#barrGoogleAPI"),
            Cr = $("#ggAPI"),
            kr = "",
            Lr = "",
            Ar = "",
            Or = $("#font-setting-box"),
            Mr = $("li#ligAPI"),
            _r = $("li#ligFf"),
            Dr = $("#ChangeAPInow"),
            Pr = $(".dropdown div ul"),
            Hr = $(".dropdown1 div ul"),
            Br = $(".dropdown"),
            jr = $(".dropdown1");
    ji(true);
    Zr();
    wi();
    Ei();
    Yr();
    Ir();
    Ni();
    Si();
    xi();
    Ti();
    Ci();
    Xi();
    Mi();
    ki();
    Li();
    fi();
    _i();
    screenshotPreview();
    Di();
    Pi();
    Ui();
    ni(hIL);
    ti(IL);
    si();
    oi();
    ui();
    ai();
    li();
    Fi();
    qr();
    Gr();
    Oi();
    Wi();
    Ai();
    Xr();
    $r();
    Fr();
    zr();
    Ur();
    Jr();
    Wr();
    $("div#color-none").click(function() {
        $(CK).find(".divider .border,.gray").css("background", "none");
        $(hCK).find(".divider .border,.gray").css("background", "none")
    });
    ri();
    Lt.resize(function() {
        wi()
    }).resize();
    $.generateFile = function(e) {

        e = e || {};
//        if (!e.script || !e.filename || !e.content) {
//            Xn.html("**** Please enter all the required config options!").css("display", "none").fadeIn();
//            alert("**** Please enter all the required config options!")
//        }
        if (templateName != "") {
            var title = "Email Template Updated SuccessFully";
        } else {
            var title = "Email Template Saved SuccessFully";
        }
        swal({
            title: "Template Info",
            text: '<input class="visibleInput" id="templateName" type="text" name="templateName" value="' + templateName + '" placeholder="Enter Template Name"><br><textarea class="visibleInput templateDesc" id="templateDesc" name="templateDesc" placeholder="Template Description">' + templateDescription + '</textarea>',
            html: true,
            showCancelButton: true,
        },
                function(response) {
                    if (response == true) {
                        templateName = $("#templateName").val();
                        var templateDescription = $("#templateDesc").val();

                        $.ajax({
                            url: '/emails',
                            type: 'post',
                            data: {
                                "content": e.content,
                                "_token": $("input[name=_token]").val(),
                                "templateId": templateId,
                                "templateName": templateName,
                                "templateDescription": templateDescription


                            },
                            success: function(result) {
                                swal({
                                    title: title,
                                    text: "",
                                    type: "success",
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Ok",
                                    closeOnConfirm: true

                                },
                                function(response) {
                                    if (response == true) {
                                        window.location = APP_URL + "/emails";
                                    }
                                    else {
                                        return false;
                                    }

                                });
                            }
                        });
                    }
                });



        var t = $("<iframe>", {
            width: 1,
            height: 1,
            frameborder: 0,
            css: {
                display: "none"
            }
        }).appendTo(bo);
        var n = '<form action="" method="post">' + '<input type="hidden" name="filename" />' + '<input type="hidden" name="content" />' + "</form>";
        setTimeout(function() {
            var r = t.prop("contentDocument") !== undefined ? t.prop("contentDocument").body : t.prop("document").body;
            r = $(r);
            r.html(n);
            var i = r.find("form");
            i.attr("action", e.script);
            i.find("input[name=filename]").val(e.filename);
            i.find("input[name=content]").val(e.content);
            i.submit()
        }, 50)

    }
});
if (top.location != location)
    top.location.href = location.href
$(document).ready(function() {
    $("#choose-module").trigger("click");
});
