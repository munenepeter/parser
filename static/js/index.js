function customInput(el) {
  const fileInput = el.querySelector('[type="file"]')
  const label = el.querySelector('[data-js-label]')

  fileInput.onchange =
    fileInput.onmouseout = function () {
      if (!fileInput.value) return

      var value = fileInput.value.replace(/^.*[\\\/]/, '')
      el.className += ' -chosen'
      label.innerText = value
    }
}
/**
 * 
 * Handle Doc Upload
 */
const form = document.querySelector("#doc-form");
form.addEventListener("submit", (e) => {
  e.preventDefault();
  document.getElementById("loader").style.display = "block";

  const formData = new FormData(form);
  const url = "/src/parse.php";
  axios
    .post(url, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    })
    .then((res) => {
      console.log(res);
      document.getElementById("loader").style.display = "none";
      document.getElementById("submitpdf").style.display = "none";
      document.getElementById("file_input").style.display = "none";

      document.getElementById("doc-label").innerText = "The following have been found to be possible LI's within the file";
      document.getElementById("doc-label-guide").innerText = "Confirm and copy them to your clipboard";

      document.getElementById("doc-content").style.display = "block";

      document.getElementById('content').innerHTML = res.data.text;
      document.getElementById('flis').innerHTML = res.data.lis_found;

      document.getElementById("clear").style.display = "block";
      document.getElementById("lis-found").style.display = "block";
    })
    .catch((err) => {
      console.log(err);
    });

});
/**
 * 
 * Clear Button
 */
const clearBtn = document.getElementById('clear');
clearBtn.addEventListener('click', () => {
  document.getElementById("lis-found").style.display = "none";

  document.getElementById('content').innerHTML = '';

  document.getElementById("doc-label").innerText = "Welcome to Document Parser";
  document.getElementById("doc-label-guide").innerText = "Select document to parse";

  document.getElementById("submitpdf").style.display = "block";
  document.getElementById("file_input").style.display = "block";

  document.querySelector("form").reset();

  document.getElementById("doc-content").style.display = "none";
  document.getElementById("clear").style.display = "none";
});

/**
 * 
 * Handle Text inputs
 */

let textForm = document.querySelector("#txt-form")
textForm.addEventListener("submit", (e) => {
  e.preventDefault();
  document.getElementById("loader").style.display = "block";

  const formData = new FormData(textForm);
  const url = "/src/parse.php";
  axios
    .post(url, formData)
    .then((res) => {
      console.log(res);
      document.getElementById("loader").style.display = "none";
      document.getElementById("doc-txt-textarea").style.display = "none";
      document.getElementById("submittext").style.display = "none";

      document.getElementById("text-label").innerText = "The following have been found to be possible LI's within the file";
      document.getElementById("text-label-guide").innerText = "Confirm and copy them to your clipboard";

      document.getElementById("txt-content").style.display = "block";

      document.getElementById('text-content').innerHTML = res.data.text;
      document.getElementById('flis-txt').innerHTML = res.data.lis_found;

      document.getElementById("clear").style.display = "block";
      document.getElementById("lis-found-txt").style.display = "block";
    })
    .catch((err) => {
      console.log(err);
    });

});


/**
 * 
 * Handle URL inputs
 */

let urlForm = document.querySelector("#url-form")
urlForm.addEventListener("submit", (e) => {
  e.preventDefault();
  document.getElementById("loader-url").style.display = "block";

  const formData = new FormData(urlForm);
  const url = "/src/parse.php";
  axios
    .post(url, formData)
    .then((res) => {
      console.log(res);
      document.getElementById("loader-url").style.display = "none";
      document.getElementById("url-input").style.display = "none";
      document.getElementById("submiturl").style.display = "none";

      document.getElementById("url-label").innerText = "The following have been found to be possible LI's within the file";
      document.getElementById("url-label-guide").innerText = "Confirm and copy them to your clipboard";

      document.getElementById("url-content").style.display = "block";

      document.getElementById('uri-content').innerHTML = res.data.text;
      document.getElementById('flis-url').innerHTML = res.data.lis_found;

      document.getElementById("clear").style.display = "block";
      document.getElementById("lis-found-url").style.display = "block";
    })
    .catch((err) => {
      console.log(err);
    });

});