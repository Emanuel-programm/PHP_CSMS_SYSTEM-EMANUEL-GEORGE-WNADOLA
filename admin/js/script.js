$(document).ready(function() {
    $('#summernote').summernote({
        height:200
    });
  });

  // checkbox functionality checking
  $(document).ready(function(){ 
$('#selectAllBoxes').click(function(e){
if(this.checked){
    $('.selectAllBoxes').each(function(){
        this.checked=true;
    }
    );
}
else{
    $('.selectAllBoxes').each(function(){
        this.checked=false;
    }
    );    
}
})

  })
