(function() {
    function t(t) {
        this.data = t.path || t.data, this.imageData = [], this.multiplier = t.multiplier || 1, this.padding = t.padding || 0, this.fps = t.fps || 25, this.stepsPerFrame = ~~t.stepsPerFrame || 1, this.trailLength = t.trailLength || 1, this.pointDistance = t.pointDistance || .05, this.domClass = t.domClass || "sonic", this.fillColor = t.fillColor || "#FFF", this.strokeColor = t.strokeColor || "#FFF", this.stepMethod = typeof t.step == "string" ? s[t.step] : t.step || s.square, this._setup = t.setup || e, this._teardown = t.teardown || e, this._preStep = t.preStep || e, this.width = t.width, this.height = t.height, this.fullWidth = this.width + 2 * this.padding, this.fullHeight = this.height + 2 * this.padding, this.domClass = t.domClass || "sonic", this.setup()
    }
    var e = function() {},
        n = t.argTypes = {
            DIM: 1,
            DEGREE: 2,
            RADIUS: 3,
            OTHER: 0
        },
        r = t.argSignatures = {
            arc: [1, 1, 3, 2, 2, 0],
            bezier: [1, 1, 1, 1, 1, 1, 1, 1],
            line: [1, 1, 1, 1]
        },
        i = t.pathMethods = {
            bezier: function(e, t, n, r, i, s, o, u, a) {
                e = 1 - e;
                var f = 1 - e,
                    l = e * e,
                    c = f * f,
                    h = l * e,
                    p = 3 * l * f,
                    d = 3 * e * c,
                    v = c * f;
                return [h * t + p * s + d * u + v * r, h * n + p * o + d * a + v * i]
            },
            arc: function(e, t, n, r, i, s) {
                var o = (s - i) * e + i,
                    u = [Math.cos(o) * r + t, Math.sin(o) * r + n];
                return u.angle = o, u.t = e, u
            },
            line: function(e, t, n, r, i) {
                return [(r - t) * e + t, (i - n) * e + n]
            }
        },
        s = t.stepMethods = {
            square: function(e, t, n, r, i) {
                this._.fillRect(e.x - 3, e.y - 3, 6, 6)
            },
            fader: function(e, t, n, r, i) {
                this._.beginPath(), this._last && this._.moveTo(this._last.x, this._last.y), this._.lineTo(e.x, e.y), this._.closePath(), this._.stroke(), this._last = e
            }
        };
    t.prototype = {
        setup: function() {
            var e, t, s, o, u = this.data;
            this.canvas = document.createElement("canvas"), this._ = this.canvas.getContext("2d"), this.canvas.className = this.domClass, this.canvas.height = this.fullHeight, this.canvas.width = this.fullWidth, this.points = [];
            for (var a = -1, f = u.length; ++a < f;) {
                e = u[a].slice(1), s = u[a][0];
                if (s in r)
                    for (var l = -1, c = e.length; ++l < c;) {
                        t = r[s][l], o = e[l];
                        switch (t) {
                            case n.RADIUS:
                                o *= this.multiplier;
                                break;
                            case n.DIM:
                                o *= this.multiplier, o += this.padding;
                                break;
                            case n.DEGREE:
                                o *= Math.PI / 180
                        }
                        e[l] = o
                    }
                e.unshift(0);
                for (var h, p = this.pointDistance, d = p; d <= 1; d += p) d = Math.round(d * 1 / p) / (1 / p), e[0] = d, h = i[s].apply(null, e), this.points.push({
                    x: h[0],
                    y: h[1],
                    progress: d
                })
            }
            this.frame = 0
        },
        prep: function(e) {
            if (e in this.imageData) return;
            this._.clearRect(0, 0, this.fullWidth, this.fullHeight);
            var t = this.points,
                n = t.length,
                r = this.pointDistance,
                i, s, o;
            this._setup();
            for (var u = -1, a = n * this.trailLength; ++u < a && !this.stopped;) {
                s = e + u, i = t[s] || t[s - n];
                if (!i) continue;
                this.alpha = Math.round(1e3 * (u / (a - 1))) / 1e3, this._.globalAlpha = this.alpha, this._.fillStyle = this.fillColor, this._.strokeStyle = this.strokeColor, o = e / (this.points.length - 1), indexD = u / (a - 1), this._preStep(i, indexD, o), this.stepMethod(i, indexD, o)
            }
            return this._teardown(), this.imageData[e] = this._.getImageData(0, 0, this.fullWidth, this.fullWidth), !0
        },
        draw: function() {
            this.prep(this.frame) || (this._.clearRect(0, 0, this.fullWidth, this.fullWidth), this._.putImageData(this.imageData[this.frame], 0, 0)), this.iterateFrame()
        },
        iterateFrame: function() {
            this.frame += this.stepsPerFrame, this.frame >= this.points.length && (this.frame = 0)
        },
        play: function() {
            this.stopped = !1;
            var e = this;
            this.timer = setInterval(function() {
                e.draw()
            }, 1e3 / this.fps)
        },
        stop: function() {
            this.stopped = !0, this.timer && clearInterval(this.timer)
        }
    }, window.Sonic = t
})()