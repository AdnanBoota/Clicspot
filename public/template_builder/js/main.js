this.screenshotPreview = function() {
    xOffset = 10;
    yOffset = 30;
    $("a.screenshot").hover(function(e) {
        this.t = this.title;
        this.title = "";
        var c = (this.t != "") ? "<br/>" + this.t : "";
        $("body").append("<p id='screenshot'><img src='" + this.rev + "' alt='Template Preview' style='max-width:450px;height:auto;' />" + c + "</p>");
        $("#screenshot").css("top", (e.pageY - xOffset) + "px").css("left", (e.pageX + yOffset) + "px").fadeIn("fast")
    }, function() {
        this.title = this.t;
        $("#screenshot").remove()
    });
    $("a.screenshot").mousemove(function(e) {
        $("#screenshot").css("top", (e.pageY - xOffset) + "px").css("left", (e.pageX + yOffset) + "px")
    })
};
$(document).ready(function() {
    screenshotPreview()
});