const form = document.getElementById('fquestion');
form.addEventListener('submit', (event) => {
  event.stopPropagation();
  event.preventDefault();

  const formData = new FormData(form);

  fetch('../php/AddQuestionWithImageAjax.php', {
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
});

const addQuestion = (event) => {
  console.log(event);
};
