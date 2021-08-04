const {outerLoopStep, customLoopStep} = require('./../a11y_modules/steps.js');
const {focusElementFirst, focusElementLast} = require('./../a11y_modules/focus.js');

(function () {
  const ariaHidden = function (parent, selector) {
    const previousButton = parent.querySelector(selector);
    previousButton.tabIndex = -1;
    previousButton.setAttribute('aria-hidden', 'true');
  }

  const setRegionSlide = function (slideshow) {
    const dotNav = slideshow.querySelector('ul.uk-slideshow-nav.uk-dotnav');
    dotNav.setAttribute('role', 'region');
    dotNav.setAttribute('aria-label', 'carousel');
    return dotNav;
  }

  const customStepGoToTop = function (parent, div) {
    setTimeout(function () {
      focusElementLast(parent);
    }, 50);
  }

  const customStepGoToBottom = function (parent, div) {
    setTimeout(function () {
      focusElementFirst(parent);
    }, 50);
  }

  const slideshows = document.querySelectorAll('[uk-slideshow]');

  slideshows.forEach(function (slideshow) {
    const slideshowItemsContainer = slideshow.querySelector('ul.uk-slideshow-items');
    const slideshowItems = slideshowItemsContainer.querySelectorAll('li');

    customLoopStep(slideshowItemsContainer.parentElement, customStepGoToTop, customStepGoToBottom);
    outerLoopStep(slideshowItemsContainer.parentElement);

    setTimeout(function () {
      const dotNav = setRegionSlide(slideshow);
      const dotNavsLinks = dotNav.querySelectorAll('a');

      dotNavsLinks.forEach(function (dotNavLink) {
        dotNavLink.addEventListener('focus', function (e) {
          const isActive = dotNavLink.parentElement.classList.contains('uk-active');
          if (!isActive) this.click();
        });

        dotNavLink.addEventListener('click', function (e) {
          const itemId = this.parentElement.attributes["uk-slideshow-item"].value;
          const slideshowItem = slideshowItems[itemId];
          slideshowItem.focus();
        });
      });
    }, 500);

    ariaHidden(slideshow, '[uk-slidenav-previous]');
    ariaHidden(slideshow, '[uk-slidenav-next]');
  });
})();
