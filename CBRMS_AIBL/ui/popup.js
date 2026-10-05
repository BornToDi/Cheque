document.addEventListener('DOMContentLoaded', function () {
  if (document.body.classList.contains('modern-app') || document.body.classList.contains('login-page')) return;
  document.body.classList.add('modern-app', 'popup-page');
  var wrapper = document.createElement('main'); wrapper.className = 'legacy-content';
  while (document.body.firstChild) wrapper.appendChild(document.body.firstChild);
  document.body.appendChild(wrapper);
});
