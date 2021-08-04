(function () {
  /**
 * Start ARIA Dialog (a11y)
 */
  var data_dialogs = ['offcanvas', 'modal'];
  var a11y_dialog = a11y_dialog || {};
  a11y_dialog.Utils = a11y_dialog.Utils || {};

  a11y_dialog.KeyCode = {
    BACKSPACE: 8,
    TAB: 9,
    RETURN: 13,
    ESC: 27,
    SPACE: 32,
    PAGE_UP: 33,
    PAGE_DOWN: 34,
    END: 35,
    HOME: 36,
    LEFT: 37,
    UP: 38,
    RIGHT: 39,
    DOWN: 40,
    DELETE: 46
  };

  (function (aria, data_dialogs) {

    aria.getCurrentDialog = function () {
      return this.dialogNode !== null ? this.dialogNode : false;
    };

    aria.closeCurrentDialog = function () {
      var currentDialog = aria.getCurrentDialog();
      if (currentDialog) {
        // currentDialog.close();
        UIkit[aria.dialog_type](currentDialog).hide();
        // UIkit.offcanvas(currentDialog).hide();
        return true;
      }
      return false;
    };

    aria.handleEscape = function (event) {
      var key = event.which || event.keyCode;
      if (key === aria.KeyCode.ESC && aria.closeCurrentDialog()) {
        event.stopPropagation();
      }
    };

    aria.dialog_button_click = null;
    aria.dialog_type = null;
    aria.dialogNode = null;
    aria.wrapperNode = null;
    aria.wrapperClass = 'a11y__dialog-wrapper';
    aria.preNode = null;
    aria.postNode = null;
    aria.lastFocus = null;

    aria.Utils.attemptFocus = function (element) {
      try {
        var hasTabindex = element.getAttribute('tabindex');
        if (hasTabindex !== null && hasTabindex < 0) throw 'No focusable';
        var hasAriahidden = element.getAttribute('aria-hidden');
        if (hasAriahidden !== null && hasAriahidden === 'true') throw 'No focusable';
        element.focus();
      } catch (error) { }
      return (document.activeElement === element);
    }

    aria.Utils.focusFirstDescendant = function (element) {
      for (var i = 0; i < element.childNodes.length; i++) {
        var child = element.childNodes[i];
        if (aria.Utils.attemptFocus(child) || aria.Utils.focusFirstDescendant(child)) {
          return true;
        }
      }
      return false;
    }

    aria.Utils.focusLastDescendant = function (element) {
      for (var i = element.childNodes.length - 1; i >= 0; i--) {
        var child = element.childNodes[i];
        if (aria.Utils.attemptFocus(child) || aria.Utils.focusLastDescendant(child)) {
          return true;
        }
      }
      return false;
    }

    aria.getDivStep = function (dialog, whichDiv, insertDivFun) {
      var divId = dialog.id + whichDiv;
      var div = dialog.querySelector('#' + divId);
      if (div === null) {
        div = document.createElement('div');
        div.id = divId;
        div.tabIndex = 0;
        return insertDivFun(dialog, div);
      }
      return div;
    }

    aria.createInitAndEndSteps = function (dialog, wrapperNode) {
      this.preNode = aria.getDivStep(dialog, 'Pre', function (dialog, div) {
        return dialog.insertBefore(div, dialog.firstElementChild)
      });

      this.postNode = aria.getDivStep(dialog, 'Post', function (dialog, div) {
        return dialog.appendChild(div, dialog.lastElementChild);
      });

      this.preNode.addEventListener('focus', function (e) {
        aria.Utils.focusLastDescendant(wrapperNode);
      });
      this.postNode.addEventListener('focus', function (e) {
        aria.Utils.focusFirstDescendant(wrapperNode);
      });
    }

    aria.getWrapper = function (dialog) {
      var wrapperNode = dialog.getElementsByClassName(this.wrapperClass);
      if (wrapperNode.length > 0) {
        return wrapperNode[0];
      }
      return false;
    }

    aria.handleClick = function (dialog) {
      this.wrapperNode = this.getWrapper(dialog);
      if (!this.wrapperNode) return;

      this.createInitAndEndSteps(dialog, this.wrapperNode);
      this.Utils.focusFirstDescendant(this.wrapperNode);
      this.lastFocus = document.activeElement;
    }

    aria.setEventsOnButtons = function (data_dialogs) {
      data_dialogs.forEach(function (data_dialog) {
        var dialogs_buttons_click = document.querySelectorAll('[data-' + data_dialog + ']');
        dialogs_buttons_click.forEach(function (dialog_button_click) {
          var dialog_id = dialog_button_click.dataset[data_dialog];
          UIkit.util.on('#' + dialog_id, 'shown', function () {
            aria.dialog_type = data_dialog;
            aria.dialog_button_click = dialog_button_click;
            aria.dialogNode = document.querySelector('#' + dialog_id);
            if (!aria.dialogNode) return;
            aria.handleClick(aria.dialogNode);
          });
          UIkit.util.on('#' + dialog_id, 'hidden', function () {
            aria.Utils.attemptFocus(aria.dialog_button_click);
          });
        });
      });

      document.addEventListener('keyup', aria.handleEscape);
    };

    aria.setEventsOnButtons(data_dialogs);
  }(a11y_dialog, data_dialogs));
})();
