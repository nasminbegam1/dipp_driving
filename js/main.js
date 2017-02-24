var video_click_id = '';
$.fn.interactive = function(options) {
	var _this;
	this[0].interactive = {
		
		max: 60.126,
		
		clicks: [],
		
		stops: [],
		
		stopped: {},
		
		hazard_times: {},
		
		target: $(this),
		
		review_mode: false,
		
		init: function() {
			//console.log(_this.interactive.target);
			// Selectors
			_this.interactive.video = _this.interactive.target.find("video"),
			_this.interactive.videoClickScore = _this.interactive.target.find(".video-resize"),
			_this.interactive.videoClickScore1 = _this.interactive.target.find(".video-annotations"),
			_this.interactive.videoSlider = _this.interactive.target.find(".video-ui-progress"), 
			_this.interactive.car = $("<div class='video-car'><div class='blip'></div></div>"),
			_this.interactive.videoPlay = $('.video-play'), 
			_this.interactive.videoRetake = _this.interactive.target.find('.video-retake'),
			_this.interactive.videoReview = _this.interactive.target.find('.video-review'),
			_this.interactive.circle = _this.interactive.target.find(".va-circle"),
			_this.interactive.square = _this.interactive.target.find(".va-square"),
			_this.interactive.text = _this.interactive.target.find(".text"),
			_this.interactive.getStopPoints(),
			_this.interactive.getHazards();
			
			
			_this.interactive.video.attr("src", _this.interactive.videoFile);
			_this.interactive.video[0].addEventListener("play", function() {
				_this.interactive.videoPlay.hide();
				_this.interactive.timerCallback();
			}, false);
			
			_this.interactive.video[0].addEventListener("ended", function() {
				if (_this.interactive.review_mode) _this.interactive.score();
				else _this.interactive.score()
			}, false);
			
			_this.interactive.videoReview.click(function() {
				_this.interactive.review()
			});
			
			_this.interactive.videoRetake.click(function() {
				_this.interactive.review_mode = false;
				$.each(_this.interactive.hazard_times, function(i, t) { 
					_this.interactive.hazard_times[i].h = false;
				});
				$.each(_this.interactive.stopped, function(i, t) { 
					_this.interactive.stopped[i].s = false;
				});
				
				_this.interactive.clicks = [];
				_this.interactive.clearTickMarks();
				_this.interactive.video[0].setAttribute("src", _this.interactive.videoFile);
				_this.interactive.target.find(".video-score").hide();
				_this.interactive.circle.removeClass("clicked");
				_this.interactive.video[0].play();
				
			});
			
			_this.interactive.videoClickScore.click(function(e) {
				if (_this.interactive.review_mode) return false;
				_this.interactive.clicks.push({
					t: _this.interactive.video[0].currentTime
				});
				var x = _this.interactive.videoSlider.find(".ui-slider-handle").css("left");
				$('<span class="ui-slider-tick-mark ui-slider-tick-mark-g"></span>').css('left', x).appendTo(_this.interactive.videoSlider)
			});
			_this.interactive.videoClickScore1.click(function(e) {
				if (_this.interactive.review_mode) return false;
				_this.interactive.clicks.push({
					t: _this.interactive.video[0].currentTime
				});
				var x = _this.interactive.videoSlider.find(".ui-slider-handle").css("left");
				$('<span class="ui-slider-tick-mark ui-slider-tick-mark-g"></span>').css('left', x).appendTo(_this.interactive.videoSlider)
			});
			
			//$('#video').on('click',function(e) {
			//	if (_this.interactive.review_mode) return false;
			//	_this.interactive.clicks.push({
			//		t: _this.interactive.video[0].currentTime
			//	});
			//	var x = _this.interactive.videoSlider.find(".ui-slider-handle").css("left");
			//	$('<span class="ui-slider-tick-mark ui-slider-tick-mark-g"></span>').css('left', x).appendTo(_this.interactive.videoSlider)
			//});
			
			
			_this.interactive.circle.removeClass("clicked");
			_this.interactive.circle.click(function(e) {
				if (_this.interactive.review_mode || !_this.interactive.circle.hasClass("cv_move")) return false;
				if(!_this.interactive.circle.hasClass("clicked")) {
					_this.interactive.circle.addClass("clicked");
					_this.interactive.clicks.push({
						t: _this.interactive.video[0].currentTime
					});
					var x = _this.interactive.videoSlider.find(".ui-slider-handle").css("left");
					$('<span class="ui-slider-tick-mark ui-slider-tick-mark-r r-clicked"></span>').css('left', x).appendTo(_this.interactive.videoSlider);
				}
			});			
			
			_this.interactive.videoSlider.slider({
				max: _this.interactive.max,
				value: 0,
				step: 0.00000001,
				disabled: true,
			});
			
			_this.interactive.videoSlider.append(_this.interactive.car);
			
			_this.interactive.videoPlay.click(function() {
				video_click_id = $(this).attr('data-attr');
				
				_this.interactive.target.find(".video-overlay").hide();
				_this.interactive.video[0].play()
			});
			
			
			/*$("#NEXT").click(function() { 
				_this.interactive.target.find(".video-overlay").hide();
				var s = parseInt($("#NEXT").attr("data-stop"));
				var p = parseInt($("#NEXT").attr("data-prev"));
				t = _this.interactive.stops[s];
				s++;
				ind = "stop_" + t; 
				$("#NEXT").attr("data-stop", s);
				_this.interactive.video[0].currentTime = t;
				
				if(!isNaN($("#NEXT").attr("data-prev")))
					_this.interactive.annotation.hide(_this.interactive.stopped["stop_" + _this.interactive.stops[p]]),
					p++;
				else
					p = 0;
				
				$("#NEXT").attr("data-prev", p);
				
				console.log(_this.interactive.stopped[ind]);
				_this.interactive.annotation.show(_this.interactive.stopped[ind]);
			});*/
			
			_this.interactive.load();
		},
		
		load: function() { 
			setTimeout(function() { 
				_this.interactive.resize(function() { 
					$("#video").animate({ opacity: 1 }, 150); 
				});
			}, 300);
		},
		
		timerCallback: function() {
			if (_this.interactive.video[0].paused || _this.interactive.video[0].ended) return true;
			
			_this.interactive.videoSlider.slider("value", _this.interactive.video[0].currentTime);
			
			var l = _this.interactive.videoSlider.find(".ui-slider-handle").css("left");
		
			_this.interactive.car.css({ left: l });  
		
			var t = (Math.round(_this.interactive.video[0].currentTime * 10) / 10);
			var ind = "haz_" + t;
			var timeout = function() { 
				setTimeout(function() { 
					_this.interactive.timerCallback();
				}, 1);
			};
			if(_this.interactive.review_mode && _this.interactive.stops.indexOf(t) != -1) { 
					ind = "stop_" + t;
					if(!_this.interactive.stopped[ind].s)
						_this.interactive.stopped[ind].s = true, 
						_this.interactive.videoSlider.slider("value", _this.interactive.video[0].currentTime),
						_this.interactive.annotation.show(_this.interactive.stopped[ind]),
						_this.interactive.pause(4, function() { 
							_this.interactive.annotation.hide(_this.interactive.stopped[ind]);
							_this.interactive.timerCallback();
						});
						timeout();
			} else if(typeof(_this.interactive.hazard_times[ind]) != "undefined" && !_this.interactive.hazard_times[ind].h) { 
					_this.interactive.hazard_times[ind].h = true, 
					_this.interactive.videoSlider.slider("value", _this.interactive.video[0].currentTime),
					_this.interactive.hazard.show(_this.interactive.hazard_times[ind]);	
					timeout();
			} else { 
				timeout();
			}
		},
		
		annotation: { 
			show: function(a) { 
				$("." + a.c).attr("class", a.c + " " + a.d);
				_this.interactive.text.html(a.a).attr("class", "text " + a.e);
				
			},
			
			hide: function(a) { 
				$("." + a.c).attr("class", a.c);
				_this.interactive.text.attr("class", "text");
			},
		},
		
		hazard: { 
			show: function(h) { 
				_this.interactive.circle.attr("class", "va-circle " + h.c);
				setTimeout(function() { 
					_this.interactive.hazard.hide();
				}, h.d);
				
			},
			hide: function() { 
				_this.interactive.circle.attr("class", "va-circle");		
			},
		},
		
		resize: function(callback) { 
			/* Maintain 16:9 */
			var vh = $("body").height(),
				vw = _this.interactive.get_width(vh);
			
			if(vw > $("body").width())
				vw = $("body").width(),
				vh = _this.interactive.get_height(vw);
				
			
			var el = $("video, .video-annotations, #video");
			el.animate({ width: vw + "px", height: vh + "px" }, 0, function() { 
				if(typeof(callback) == "function")
					callback();
			});
			
			$(".video-score, .video-overlay").css({ width: vw });
		},
		
		get_height: function(w) { 
			return (1080 / 1920)*w;
		},
		
		get_width: function(h) { 
			return (1920 / 1080)*h;
		},
		
		fullscreen: function() { 
			/* Maintain 16:9 */
			//var vh = 
		},
		
		timeToValue: function(t) {
			return ((t / _this.interactive.max) * _this.interactive.max)
		},
		
		valueToPixels: function(v) {
			return v * (_this.interactive.videoSlider.width() / _this.interactive.max)
		},
		
		clearTickMarks: function() {
			_this.interactive.target.find(".ui-slider-tick-mark").remove()
		},
		
		score: function() {
			var s = 0;
			
			$.each(_this.interactive.clicks, function(u, c) {
				$.each(_this.interactive.scoring, function(i, h) {
					if ( _this.interactive.scoring.length > (i+1)) {
						if (c.t>h.t && c.t<_this.interactive.scoring[(i+1)].t) {
							s = h.s
							
						}
					}else{
						if (c.t>h.t) {
							s = h.s
						}
					}
					if(s)return false;
				});
				if(s)return false; 
			});
			
			$.ajax({
				type: 'post',
				data: 'video_click_id='+video_click_id+'&score='+s,
				url: _baseUrl + 'learn/score_save'
			});
			if(s < 4) 
				$(".video-msg").html("You ideally need to be able to score at least 4 out of 5 points in each video.<br><br>REMEMBER: A developing hazard is one which will eventually cause you to change course, speed or even stop.<br><br>I RECOMMEND that you DO NOT look at the answers to this video until you can score at least4 out of 5 points on it.");
			else
				$(".video-msg").html("Congratulations, if you consistently score like this you have a good chance of passing your real test!");
			
			_this.interactive.target.find(".video-score-text").html(s),
			_this.interactive.target.find(".video-score").show();
			_this.interactive.target.find(".video-score").find("p")
		},
		
		review: function() {
			$(".video-score").hide();
			
			_this.interactive.video[0].setAttribute("src", _this.interactive.videoFileReview);
			
			// Hazards
			var last = 0;
			$.each(_this.interactive.scoring, function(i, h) {
				var x = _this.interactive.valueToPixels(h.t),
				distance = (x - last);
				
				
				$('<span class="ui-slider-tick-mark ui-slider-tick-mark-r"></span>').css({
					//width: distance + 2 + "px",
					left: x + "px",
					opacity: ((100 / _this.interactive.scoring.length) * (i + 1)) / 100
				}).appendTo(_this.interactive.videoSlider)
				
				last = x;
			}), 
		
		
			// Annotations
			$.each(_this.interactive.annotations, function(i, a) {
				var x = _this.interactive.valueToPixels(a.t);
				$('<span class="ui-slider-tick-mark ui-slider-tick-mark-' + a.color + '"></span>').css({
					left: x + "px",
				}).appendTo(_this.interactive.videoSlider)
			});
			
			_this.interactive.video[0].currentTime = 0;
			_this.interactive.review_mode = true;
			_this.interactive.video[0].play();
		},
		
		getStopPoints: function() {
			$.each(_this.interactive.annotations, function(i, s) {
				_this.interactive.stopped["stop_" + s.t] = { 
					// stopped, annotation, time, shape, shape class, text class 
					s: false,
					a: s.a,
					t: s.t,
					c: s.c,
					d: s.d,
					e: s.e,
					color: s.color,
				};
				_this.interactive.stops.push(s.t);
			});
		},
		
		getHazards: function() { 
			_this.interactive.hazard_times = { };
			$.each(_this.interactive.hazards, function(i, h) { 
				_this.interactive.hazard_times["haz_" + h.t] = { 
					// stopped, score, class, time
					h: false,
					c: h.c, 
					t: h.t,
					d: h.d,
				}
			});
		
		},
		
		pause: function(s, callback) {
			_this.interactive.video[0].pause();
			//setTimeout(function() {
			//$(".video-overlay").addClass("video-overlay-pause").show();
			_this.interactive.videoPlay.show();
			_this.interactive.videoPlay.unbind("click").click(function() { 
				_this.interactive.video[0].play();
				$(".video-overlay").removeClass("video-overlay-pause").hide();
				if(typeof(callback) != "undefined") 
						callback();
			});
					
		//	}, s*1000)
		},
	};
	_this = this[0];
	_this.interactive = $.extend({}, _this.interactive, options);
	_this.interactive.init()
};