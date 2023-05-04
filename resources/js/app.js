import './bootstrap';


/* global bootstrap: false */
(function () {
    'use strict'
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl)
    })
  })()
  

// Flash Messages
setTimeout(() => {
  document.querySelector('.alert').classList.remove('show');
  document.querySelector('.alert').classList.add('hide');
}, 10000);

document.querySelector('.close-btn').onclick = (e) => {
  document.querySelector('.alert').classList.remove('show');
  document.querySelector('.alert').classList.add('hide');
}