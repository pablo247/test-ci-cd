var {attemptFocus, focusElementFirst, focusElementLast, focusNextElementOfOuterParent, focusPreviousElementOfOuterParent} = require('./focus.js');

(function () {

  const createDiv = function (parent, insertDivFunction) {
    var div = null;
    if (parent !== null)
    {
      div = document.createElement('div');
      div.tabIndex = 0;
      insertDivFunction(parent, div);
    }
    return div;
  }

  const getFirstDiv = function (parent) {
    return createDiv(parent, function (parent, div) {
      parent.insertBefore(div, parent.firstElementChild);
    });
  }

  const getLastDiv = function (parent) {
    return createDiv(parent, function (parent, div) {
      parent.appendChild(div, parent.lastElementChild);
    });
  }

  const waitingStep = function (parent) {
    const mainFirstDiv = getFirstDiv(parent);
    mainFirstDiv.addEventListener('focusout', function (e) {
      mainFirstDiv.setAttribute("tabindex", "-1");
    });
    setTimeout(function () {
      attemptFocus(mainFirstDiv);
    }, 500);
  }

  const innerLoopStep = function (parent) {
    const mainFirstDiv = getFirstDiv(parent);
    mainFirstDiv.addEventListener('focus', function (e) {
      setTimeout(function () {
        focusElementLast(parent);
      }, 50);
    });
    const mainLastDiv = getLastDiv(parent);
    mainLastDiv.addEventListener('focus', function (e) {
      setTimeout(function () {
        focusElementFirst(parent);
      }, 50);
    });
  }

  const outerLoopStep = function (parent) {
    const mainFirstDiv = getFirstDiv(parent);
    const mainLastDiv = getLastDiv(parent);

    mainFirstDiv.addEventListener('focus', function (e) {
      setTimeout(function () {
        focusNextElementOfOuterParent(mainLastDiv.parentElement);
      }, 50);
    });
    mainLastDiv.addEventListener('focus', function (e) {
      setTimeout(function () {
        focusPreviousElementOfOuterParent(mainLastDiv.parentElement);
      }, 50);
    });
  }

  const customLoopStep = function (parent, firstFunction, lastFunction) {
    const mainFirstDiv = getFirstDiv(parent);
    const mainLastDiv = getLastDiv(parent);

    mainFirstDiv.addEventListener('focus', function (e) {
      setTimeout(function () {
        firstFunction(parent, mainFirstDiv);
      }, 50);
    });
    mainLastDiv.addEventListener('focus', function (e) {
      setTimeout(function () {
        lastFunction(parent, mainFirstDiv);
      }, 50);
    });
  }

  module.exports = {
    getFirstDiv,
    getLastDiv,
    waitingStep,
    innerLoopStep,
    outerLoopStep,
    customLoopStep,
  }
})();
