$(document).ready(function() {
    $('#summernote').summernote({
        height: 200
    });

    // Checkbox functionality checking
    $('#selectAllBoxes').click(function(e) {
        if (this.checked) {
            $('.selectAllBoxes').each(function() {
                this.checked = true;
            });
        } else {
            $('.selectAllBoxes').each(function() {
                this.checked = false;
            });
        }
    });

    const div_box = "<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(div_box);

    $('#load-screen').delay(700).fadeOut(600, function() {
        $(this).remove();
    });
});

function loadUserOnline(){
    $.get("include/functions.php?usersonline=userresult",function(data){
        $(".usersonline").text(data);
    });

}

setInterval(function(){
loadUserOnline();
},500);

