
function preview(input) {
    if (input.files && input.files[0]) {
        var freader = new FileReader();

        freader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }
        freader.readAsDataURL(input.files[0]);
    }
}

$("#meme").change(function(){
    preview(this);
});

