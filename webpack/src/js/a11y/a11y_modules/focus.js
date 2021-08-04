(function () {

  const attemptFocus = function (element) {
    try {
      var hasTabindex = element.getAttribute('tabindex');
      if (hasTabindex !== null && hasTabindex < 0) throw 'No focusable';
      var hasAriahidden = element.getAttribute('aria-hidden');
      if (hasAriahidden !== null && hasAriahidden === 'true') throw 'No focusable';
      element.focus();
    } catch (error) { }
    return (document.activeElement === element);
  }

  const focusElementFirst = function (parent) {
    let child = null;
    for (var i = 0; i < parent.childNodes.length; i++) {
      child = parent.childNodes[i];
      if (attemptFocus(child) || focusElementFirst(child)) return true;
    }
    return false;
  }

  const checkNextElement = function (parent, current) {
    let child = null;
    let noStar = true;
    for (var i = 0; i < parent.childNodes.length; i++) {
      child = parent.childNodes[i];
      if (noStar)
      {
        if (child === current) noStar = false;
        continue;
      }
      if (attemptFocus(child) || focusElementFirst(child)) return true;
    }
    return false;
  }

  const focusNextElementOfOuterParent = function (currentNode) {
    const nodeParent = currentNode.parentElement;

    if (!checkNextElement(nodeParent, currentNode))
    {
      focusNextElementOfOuterParent(nodeParent);
    }

    document.activeElement.focus();
  }

  const focusElementLast = function (parent) {
    let child = null;
    for (var i = parent.childNodes.length - 1; i >= 0; i--) {
      child = parent.childNodes[i];
      if (attemptFocus(child) || focusElementLast(child)) {
        console.log("true", child);
        return true;
      }
    }
    return false;
  }

  const checkPreviousElement = function (parent, current) {
    let child = null;
    let noStar = true;
    for (var i = parent.childNodes.length - 1; i >= 0; i--) {
      child = parent.childNodes[i];
      if (noStar)
      {
        if (child === current) noStar = false;
        continue;
      }
      if (attemptFocus(child) || focusElementLast(child)) return true;
    }
    return false;
  }

  const focusPreviousElementOfOuterParent = function (currentNode) {
    const nodeParent = currentNode.parentElement;

    console.log(nodeParent);
    if (!checkPreviousElement(nodeParent, currentNode))
    {
      focusPreviousElementOfOuterParent(nodeParent);
    }

    document.activeElement.focus();

    return document.activeElement;
  }

  module.exports = {
    attemptFocus,
    focusElementFirst,
    focusElementLast,

    focusNextElementOfOuterParent,
    focusPreviousElementOfOuterParent,
  };

})();
