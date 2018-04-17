$(function() {
	jssor_1_slider_init();
		 

});
jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
              {$Duration:500,$Delay:30,$Cols:8,$Rows:4,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2049,$Easing:$Jease$.$OutQuad},
              {$Duration:500,$Delay:80,$Cols:8,$Rows:4,$Clip:15,$SlideOut:true,$Easing:$Jease$.$OutQuad},
              {$Duration:1000,x:-0.2,$Delay:40,$Cols:12,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Outside:true,$Round:{$Top:0.5}},
              {$Duration:2000,y:-1,$Delay:60,$Cols:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:$Jease$.$OutJump,$Round:{$Top:1.5}},
              {$Duration:1200,x:0.2,y:-0.1,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:1.3,$Top:2.5}}
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

			var MAX_WIDTH = 3000;
            var MAX_HEIGHT = 451;
            var MAX_BLEEDING = 1;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {
                    var originalWidth = jssor_1_slider.$OriginalWidth();
                    var originalHeight = jssor_1_slider.$OriginalHeight();

                    var containerHeight = containerElement.clientHeight || originalHeight;

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
                    var expectedHeight = Math.min(MAX_HEIGHT || containerHeight, containerHeight);

                    //constrain bullets, arrows inside slider area, it's optional, remove it if not necessary
                    //if (MAX_BLEEDING >= 0 && MAX_BLEEDING < 1) {
                    //    var widthRatio = expectedWidth / originalWidth;
                    //    var heightRatio = expectedHeight / originalHeight;
                    //    var maxScaleRatio = Math.max(widthRatio, heightRatio);
                    //    var minScaleRatio = Math.min(widthRatio, heightRatio);

                    //    maxScaleRatio = Math.min(maxScaleRatio / minScaleRatio, 1 / (1 - MAX_BLEEDING)) * minScaleRatio;
                    //    expectedWidth = Math.min(expectedWidth, originalWidth * maxScaleRatio);
                    //    expectedHeight = Math.min(expectedHeight, originalHeight * maxScaleRatio);
                    //}

                    //scale the slider to expected size
                    jssor_1_slider.$ScaleSize(expectedWidth, expectedHeight, MAX_BLEEDING);

                    //position slider at center in vertical orientation
                    jssor_1_slider.$Elmt.style.top = ((containerHeight - expectedHeight) / 2) + "px";

                    //position slider at center in horizontal orientation
                    jssor_1_slider.$Elmt.style.left = ((containerWidth - expectedWidth) / 2) + "px";
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }


        //     var MAX_WIDTH = 1000;

        //     function ScaleSlider() {
        //         var containerElement = jssor_1_slider.$Elmt.parentNode;
        //         var containerWidth = containerElement.clientWidth;

        //         if (containerWidth) {

        //             var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

        //             jssor_1_slider.$ScaleWidth(expectedWidth);
        //         }
        //         else {
        //             window.setTimeout(ScaleSlider, 30);
        //         }
        //     }

        //     ScaleSlider();

        //     $Jssor$.$AddEvent(window, "load", ScaleSlider);
        //     $Jssor$.$AddEvent(window, "resize", ScaleSlider);
        //     $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        //     /*#endregion responsive code end*/
        };
