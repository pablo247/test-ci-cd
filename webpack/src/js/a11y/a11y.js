const {waitingStep} = require('./a11y_modules/steps.js');
const {createToolbar} = require('./a11y_modules/toolbar.js');

(function () {
	document.addEventListener('readystatechange', function (event) {
		// All HTML DOM elements are accessible
		if (event.target.readyState === "interactive")
		{
      var a11y = a11y || {};

      (function (a11y) {
        a11y.bodyHTML = document.body;

        // Modules
        require('./a11y_modules/tabindex.js');
        createToolbar(a11y.bodyHTML);
        waitingStep(a11y.bodyHTML, true);

        // Components Uikit
        require('./a11y_uikit_components/modal.js');
        require('./a11y_uikit_components/slideshow.js');

        // Components
        require('./a11y_components/menu.js');
      })(a11y);
		}

    // Now external resources are loaded too, like css,src etc.
		if (event.target.readyState === "complete") {}

	});
})();
