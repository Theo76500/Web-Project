if ($('#zone-result').val() == "activite") {
  $('#category').css("display",'none');
} else {
  $('#category').css("display",'block');
}

$('#zone-result').on('change', function() {
  if ($('#zone-result').val() == "activite") {
    $('#category').css("display",'none');
  } else {
    $('#category').css("display",'block');
  }
});

$('#form').on('submit', function (e){
    if( $('#search-input').val() == "") {
      console.log("TEST : "+$('#search-input').val());
      e.preventDefault();
    }
})
