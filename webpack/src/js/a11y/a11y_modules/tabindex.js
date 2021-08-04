
(function () {

  const checkIfCanFocus = function (element) {
    if (element.nodeName === 'A') return false;

    if (element.nodeName !== '#text') {
      let parent = element.parentElement;
      try {
        var hasTabindex = parent.getAttribute('tabindex');
        if (hasTabindex !== null && hasTabindex >= 0) return false;
      } catch (error) { }
    }
    return true;
  }

  const checkIfIsText = function (element) {
    if (element.nodeName === '#text' && element.textContent.trim() !== '')
    {
      let parent = element.parentElement;
      try {
        var hasTabindex = parent.getAttribute('tabindex');
        if (hasTabindex !== null) throw 'Have attribute';
        var hasAriahidden = parent.getAttribute('aria-hidden');
        if (hasAriahidden !== null && hasAriahidden === 'true') throw 'No focusable';
        parent.setAttribute('tabindex', '0');
      } catch (error) { }
    }
  }

  const putTabindex = function (element) {

    let canPutTabindex = checkIfCanFocus(element);

    if (!canPutTabindex) return false;

    checkIfIsText(element);

    return true;
  }

  const checkElements = function (parent) {
    let child = null;
    for (var i = 0; i < parent.childNodes.length; i++) {
      child = parent.childNodes[i];
      let canPutTabindex = putTabindex(child);
      if (canPutTabindex) checkElements(child);
    }
  }

  let parent = document.body;
  checkElements(parent);

})();
