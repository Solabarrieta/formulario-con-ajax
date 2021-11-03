const form = document.getElementById('fquestion');
form.addEventListener('submit', (event) => {
  event.stopPropagation();
  event.preventDefault();

  const formData = new FormData(form);

  fetch('../php/AddQuestionWithImageAjax.php', {
    method: 'post',
    body: formData,
  }).catch((error) => {
    console.error(error);
  });
});

const addQuestion = (event) => {
  console.log(event);
};