/*  ==========================================
    SHOW UPLOADED IMAGE
* ========================================== */
function readURL(input,id_) {
   /*  alert(id_); */
   console.log(id_);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#'+id_)
                .attr('src', e.target.result);
        };
		
        reader.readAsDataURL(input.files[0]);
    }
}
$(function (id) {
    $('#'+id).on('change', function () {
        readURL(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
/* var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
  console.log(infoArea.textContent);
} */




