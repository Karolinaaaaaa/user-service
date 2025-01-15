document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById('userForm');
  const responseDiv = document.getElementById('response');

  if (form) {
      form.addEventListener('submit', async (e) => {
          e.preventDefault();
          const formData = new FormData(form);

          try {
              const response = await fetch('/submit', {
                  method: 'POST',
                  body: formData,
              });

              const data = await response.json();
              if (response.ok) {
                  responseDiv.innerHTML = `<p style="color: green;">${data.message}</p>`;
                  form.reset();
              } else {
                  responseDiv.innerHTML = `<p style="color: red;">${data.errors.join(', ')}</p>`;
              }
          } catch (error) {
              responseDiv.innerHTML = `<p style="color: red;">Something went wrong. Please try again.</p>`;
          }
      });
  }
});
