if (!pautonext) {
    var pautonext = true;
}
if (!resizePlayer) {
    var resizePlayer = false;
}
if (!light) {
    var light = true;
}
if (!miniPlayer) {
    var miniPlayer = false;
}
var orgPlayerSize = { width: 0, height: 0 };
var docHeight = 17;
jQuery(document).ready(function (dataAndEvents) {
    jQuery("#btn-light").on("click", function () {
        if (light == true) {
            jQuery("body").append(
                '<div id="light-overlay" style="position: fixed; z-index: 999; background-color: rgb(0, 0, 0); opacity: 0.8; top: 0px; left: 0px; width: 100%; height: 100%;"></div>'
            );
            jQuery("#watch-block").css({
                "z-index": "1000",
                position: "relative",
            });
            jQuery(this).html("B\u1eadt \u0111\u00e8n");
            light = false;
        } else {
            jQuery("div#light-overlay").remove();
            jQuery("#watch-block").css({
                "z-index": "1000",
                position: "relative",
            });
            jQuery(this).html("T\u1eaft \u0111\u00e8n");
            light = true;
        }
        fx.scrollTo("#watch-block", 1e3);
        return false;
    });
    jQuery("#btn-toggle-error").on("click", function () {
        jQuery
            .ajax({
                url: URL_POST_REPORT_ERROR,
                type: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                data: JSON.stringify({
                    message: "",
                }),
            })
            .done(function (data) {
                if (data.status)
                    fx.alertMessage(
                        "Thông báo",
                        "Báo cáo của bạn đã được gửi đi, BQT sẽ khắc phục trong thời gian sớm nhất. Thank!",
                        "success"
                    );
                else
                    fx.alertMessage(
                        "Rất tiếc",
                        "Máy chủ không tiếp nhận yêu cầu!",
                        "error"
                    );
            });
        jQuery(this).remove();
    });
    jQuery("#btn-expand").on("click", function () {
        if (resizePlayer == false) {
            orgPlayerSize.width = jQuery("#media-player-box").width();
            orgPlayerSize.height = jQuery("#media-player-box").height();
            var newWidth = 1106;
            var size = {
                width: newWidth,
                height: Math.ceil((newWidth / 16) * 9 - docHeight),
            };
            jQuery("#media-player-box").animate({
                width: size.width,
                height: size.height,
            });
            jQuery(".MovieTabNav.ControlPlayer").css({ display: "none" });
            jQuery("#watch-block")
                .animate({ width: newWidth })
                .addClass("expand");
            jQuery("body").append(
                '<div id="light-overlay" style="position: fixed; z-index: 999; background-color: rgb(0, 0, 0); opacity: 0.8; top: 0px; left: 0px; width: 100%; height: 100%;"></div>'
            );
            fx.scrollTo("#watch-block", 1e3);
            jQuery("#expand-status").html("Thu nhỏ");
            resizePlayer = true;
        } else {
        }
        return false;
    });
    jQuery("#btn-re-expand").on("click", function () {
        if (resizePlayer == true) {
            jQuery("#media-player-box").animate({
                width: "100%",
                height: "435px",
            });
            jQuery("#watch-block")
                .animate({ width: "100%" })
                .removeClass("expand");
            jQuery(".MovieTabNav.ControlPlayer").css({ display: "block" });
            jQuery("#watch-block").removeClass("expand");
            jQuery("div#light-overlay").remove();
            fx.scrollTo("#watch-block", 1e3);
            jQuery("#expand-status").html("Phóng to");
            resizePlayer = false;
        }
        return false;
    });
    jQuery("#btn-toggle-capture").on("click", function() {
        saveScreenShot("media-player");
        return false;
    });
    jQuery("#btn-toggle-download").on("click", function() {

		if (jwplayer("media-player").getPlaylistItem() == undefined) {
			fx.alertMessage("Rất tiếc", "Server của tập phim này chưa hỗ trợ download! Bạn hãy dùng Cốc Cốc, IDM hoặc chuyển server khác để download", 'info');
		}else{
			var file = jwplayer("media-player").getPlaylistItem()['file'];
			if (file.includes(".mp4")) {
				window.open(file, '_blank').blur();
			}else{
					fx.alertMessage("Rất tiếc", "Server của tập phim này chưa hỗ trợ download! Bạn hãy dùng Cốc Cốc, IDM hoặc chuyển server khác để download", 'info');
			}

		}
        return false;
    });
});
function saveScreenShot(Z) {
    var H = document.getElementById(jwplayer(Z).id);
    var B = (H) ? H.querySelector("video") : undefined;
    if (B) {
        jwplayer().pause(!0);
        var F = 1;
        var D = document.createElement("canvas");
        D.width = B.videoWidth * F;
        D.height = B.videoHeight * F;
        Dwidth = window.innerWidth * 0.5;
        Dwidth100 = Dwidth / (D.width / 100);
        Dheight = (D.height / 100) * Dwidth100;
        if (Dheight > 600) {
            Dheight = 600;
            Dheight100 = Dheight / (D.height / 100);
            Dwidth = D.width / 100 * Dheight100
        }
        D.setAttribute("style", "height:" + Dheight + "px");
        D.getContext("2d").drawImage(B, 0, 0, D.width, D.height);
        var G = document.createElement("div");
        var K = (window.innerHeight - Dheight - 50) / 2 + "px";
        var L = (window.innerWidth - Dwidth) / 2 + "px";
        if (window.innerWidth < 450) {
            L = "0px";
            Dwidth = window.innerWidth
        }
        var C = document.createElement("div");
        var E = "position: fixed;z-index: 9999999999999;width:" + Dwidth + "px; left: " + L + ";top:0";
        E += ";padding-bottom:10px; background: #fff;";
        E += "text-align: center;border: 1px solid rgba(0, 0, 0, 0.23);";
        C.setAttribute("style", "display: block;");
        C.appendChild(D);
        G.setAttribute("id", "popupSave");
        G.setAttribute("style", E);
        var J = document.createElement("span");
        J.innerHTML = 'Nhấp chuột phải vào màn hình chọn ( Lưu hình ảnh thành ) hoặc (Save image as)';
        J.setAttribute("style", "margin: 10px;display: block;font-weight: bold;");
        var I = document.createElement("a");
        I.innerHTML = "Đóng";
        E = "display: inline-block; margin: 0px auto;background-color: #337ab7;";
        E += "margin-top: 10px; padding: 5px 10px;";
        E += "color: #fff; border-radius: 5px; border: 1px solid #ccc; cursor: pointer;";
        I.setAttribute("style", E);
        I.onclick = function() {
            document.getElementById("popupSave").remove();
            loadVideo(infoLoad.links, null, jwplayer().getPosition(), jQuery("#media-player").width(), jQuery("#media-player").height())
        }
        ;
        G.appendChild(J);
        G.appendChild(C);
        G.appendChild(I);
        document.body.appendChild(G)
    }
}
