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
      //console.log(res);
      document.getElementById("loader").style.display = "none";
      document.getElementById("submitpdf").style.display = "none";
      document.getElementById("file_input").style.display = "none";

      document.getElementById("doc-label").innerText = "The following have been found to be possible LI's within the file";
      document.getElementById("doc-label-guide").innerText = "Please confirm them before using*";

      document.getElementById("doc-content").style.display = "block";

      document.getElementById('content').innerHTML = res.data.text;
      document.getElementById('flis').innerHTML = res.data.lis_found;
      document.getElementById('keywords_plate').innerHTML = res.data.keywords_found;

      document.getElementById("clear").style.display = "block";
      document.getElementById("lis-found").style.display = "block";
      document.getElementById("extra").style.display = "block";
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
  document.getElementById('keywords_plate').innerHTML = "";
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
  document.getElementById("doc-txt-textarea").style.display = "none";
  document.getElementById("submittext").style.display = "none";
  document.getElementById("loader-txt").style.display = "block";

  const formData = new FormData(textForm);
  const url = "/src/parse.php";
  axios
    .post(url, formData)
    .then((res) => {
      //console.log(res);
      document.getElementById("loader-txt").style.display = "none";


      document.getElementById("text-label").innerText = "The following have been found to be possible LI's within the file";
      document.getElementById("text-label-guide").innerText = "Please confirm them before using";

      document.getElementById("txt-content").style.display = "block";

      document.getElementById('text-content').innerHTML = res.data.text;
      document.getElementById('flis-txt').innerHTML = res.data.lis_found;
      document.getElementById('keywords_plate_txt').innerHTML = res.data.keywords_found;

      document.getElementById("extra_txt").style.display = "block";
      document.getElementById("clear_txt").style.display = "block";
      document.getElementById("lis-found-txt").style.display = "block";
    })
    .catch((err) => {
      console.log(err);
    });

});
/**
 * 
 * Clear Button for txt
 */
const clearBtnTxt = document.getElementById('clear_txt');
clearBtnTxt.addEventListener('click', () => {
  document.getElementById("lis-found-txt").style.display = "none";
  document.getElementById('flis-txt').innerHTML = '';
  document.getElementById('text-content').innerHTML = '';

  document.getElementById("text-label").innerText = "Welcome to Text Parser";
  document.getElementById("text-label-guide").innerText = "Paste your content here";
  document.getElementById('keywords_plate_txt').innerHTML = "";

  document.getElementById("doc-txt-textarea").style.display = "block";
  document.getElementById("submittext").style.display = "block";

  document.querySelector("#txt-form").reset();

  document.getElementById("txt-content").style.display = "none";
  document.getElementById("clear_txt").style.display = "none";
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
      // console.log(res);
      document.getElementById("loader-url").style.display = "none";
      document.getElementById("url-input").style.display = "none";
      document.getElementById("submiturl").style.display = "none";

      document.getElementById("url-label").innerText = "The following have been found to be possible LI's within the file";
      document.getElementById("url-label-guide").innerText = "Please confirm them before using";

      document.getElementById("url-content").style.display = "block";

      document.getElementById('uri-content').innerHTML = res.data.text;
      document.getElementById('flis-url').innerHTML = res.data.lis_found;
      document.getElementById('keywords_plate_url').innerHTML = res.data.keywords_found;

      document.getElementById("clear_url").style.display = "block";
      document.getElementById("lis-found-url").style.display = "block";
      document.getElementById("extra_url").style.display = "block";
    })
    .catch((err) => {
      console.log(err);
    });

});
/**
 * 
 * Clear Button for url
 */
const clearBtnURL = document.getElementById('clear_url');
clearBtnURL.addEventListener('click', () => {
  document.getElementById("lis-found-url").style.display = "none";
  document.getElementById('flis-url').innerHTML = '';
  document.getElementById('uri-content').innerHTML = '';

  document.getElementById("url-label").innerText = "Welcome to Text Parser";
  document.getElementById("url-label-guide").innerText = "Paste your content here";
  document.getElementById('keywords_plate_url').innerHTML = "";

  document.getElementById("url-input").style.display = "block";
  document.getElementById("submiturl").style.display = "block";

  document.querySelector("#url-form").reset();

  document.getElementById("url-content").style.display = "none";
  document.getElementById("clear_url").style.display = "none";
});



//get pearls

const pearls_tab_btn = document.querySelector("#pearls-tab");
pearls_tab_btn.addEventListener("click", (e) => {
  e.preventDefault();
  document.getElementById("pearls_body").style.display = "none";
  document.getElementById("loader-pearls").style.display = "block";

  const url = "/src/pearls.php";
  axios
    .get(url)
    .then((res) => {
      // console.log(res);
      document.getElementById("pearls_body").style.display = "block";
      document.getElementById("loader-pearls").style.display = "none";

      document.getElementById('pearl-notifs').innerHTML = "Viewing pearls, click <b>edit</b> to delete or add";

      document.getElementById('pearls-content').innerHTML = res.data.pearls;

    })
    .catch((err) => {
      //console.log(err);
      document.getElementById("pearls_body").style.display = "block";
      document.getElementById("loader-pearls").style.display = "none";
      document.getElementById("btns").style.display = "none";

      document.getElementById('pearl-content').classList.add("border", "border-red-600", "text-rose-500", "font-semibold");
      document.getElementById('pearls-content').innerHTML = err.response.data.message;
    });
});
//edit pearls

const edit_pearls_btn = document.querySelector("#edit-pearls");
edit_pearls_btn.addEventListener("click", (e) => {
  e.preventDefault();
  document.getElementById('save-pearls').classList.remove("hidden");
  document.getElementById('pearl-content').classList.add("border", "border-green-600", "text-green-900", );
  document.getElementById('pearl-notifs').innerHTML = "Editing the pearls, click <b>save</b> when done";

  //convert the div to content editable

});


const cache_keywords_btn = document.querySelector("#cache_keywords");
cache_keywords_btn.addEventListener("click", (e) => {
  e.preventDefault();
  cache_keywords_btn.classList.remove("text-rose-500");
  cache_keywords_btn.classList.add("text-green-500");
  cache_keywords_btn.innerHTML = "Caching keywords...";

  const url = "/src/cache_keywords.php";
  axios
    .get(url)
    .then((res) => {
      //console.log(res);
      cache_keywords_btn.innerHTML = res.data;

    })
    .catch((err) => {
      console.log(err);
    });

});