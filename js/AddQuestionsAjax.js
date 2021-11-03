//const form = document.getElementById('fquestion');
$(document).ready(function() {
  let form= $('#fquestion');
$('#fquestion').on('submit', (event) => {
  event.stopPropagation();
  event.preventDefault();

  const formData = new FormData(form[0]);

  
  
  /*fetch('../php/AddQuestionWithImageAjax.php', {
    method: 'post',
    body: formData,
  })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
    })
    .catch((error) => {
      console.error(error);
    });
});*/
$.ajax({
  url: "../php/AddQuestionWithImageAjax.php",
  type: "POST",
  data: formData,
  processData: false,
  contentType: false
});

/*$.post('../php/AddQuestionWithImageAjax.php', formData, function (data) {
  console.log(data.time);
  
} , "FormData");*/
});
})



const addQuestion = (event) => {
  console.log(event);
};