var {getFirstDiv} = require('./steps.js');
var {focusElementFirst} = require('./focus.js');

(function () {

  const createLink = function (href, text, classList=[], attributes=[]) {
    let link = document.createElement('a');

    link.href = href;
    link.text = text;
    link.classList.add('bgc-a8123d', 'uk-light', 'uk-padding-small');
    link.setAttribute('uk-scroll', '');

    classList.map(function (classItem) {
      link.classList.add(classItem);
    });
    let arrayAttribute = [];
    attributes.map(function (attribute) {
      arrayAttribute = Object.entries(attribute);
      link.setAttribute(arrayAttribute[0][0], arrayAttribute[0][1]);
    });

    return link;
  }

  const addGoToContentMainLink = function () {
    let link = createLink('#main', 'Ir al contenido principal', [], [{'aria-label':'Ir al contenido principal'}]);

    link.addEventListener('click', function () {
      focusElementFirst(document.querySelector('main'));
    });

    return link;
  }

  const createToolbar = function (parent) {
    let wrapperToolbar = getFirstDiv(parent);
    wrapperToolbar.tabIndex = -1;
    wrapperToolbar.setAttribute('role', 'toolbar');
    wrapperToolbar.classList.add("uk-position-relative","uk-position-top-left","a11y-main-controls");
    wrapperToolbar.style.zIndex = '100';

    let goToContentMainlink = addGoToContentMainLink();
    wrapperToolbar.insertBefore(goToContentMainlink, wrapperToolbar.firstElementChild);
  }

  module.exports = {
    createToolbar
  }
})();
