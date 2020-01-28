/**
 * A split button that provides a built-in dropdown arrow that can fire an event separately from the default click event
 * of the button. Typically this would be used to display a dropdown menu that provides additional options to the
 * primary button action, but any custom handler can provide the arrowclick implementation.  Example usage:
 *
 *     @example
 *     // display a dropdown menu:
 *     Ext.create('Ext.SplitButton', {
 *         renderTo: Ext.getBody(),
 *         text: 'Options',
 *         // handle a click on the button itself
 *         handler: function() {
 *             alert("The button was clicked");
 *         },
 *         menu: new Ext.menu.Menu({
 *             items: [
 *                 // these will render as dropdown menu items when the arrow is clicked:
 *                 {text: 'Item 1', handler: function(){ alert("Item 1 clicked"); }},
 *                 {text: 'Item 2', handler: function(){ alert("Item 2 clicked"); }}
 *             ]
 *         })
 *     });
 *
 * Provide custom handling to the split button when the dropdown arrow is clicked:
 *
 *     Ext.create('Ext.SplitButton', {
 *         renderTo: 'button-ct',
 *         text: 'Options',
 *         handler: optionsHandler,
 *         arrowHandler: myCustomHandler
 *     });
 *
 */
Ext.define('Ext.SplitButton', {
    extend: 'Ext.Button',
    xtype: 'splitbutton',
    requires: [
        'Ext.menu.Menu'
    ],
    isSplitButton: true,
    baseCls: Ext.baseCSSPrefix + 'splitButton',

    /**
     * @event arrowclick
     * Fires when this button's arrow is clicked.
     * @param {Ext.SplitButton} this
     * @param {Event} e The click event.
     */

    config: {
        /**
         * @cfg {Function} arrowHandler
         * @cfg {Ext.SplitButton} arrowHandler.button This Button.
         * @cfg {Ext.event.Event} arrowHandler.e The triggering event.
         * The handler function to run when the Button is tapped on.
         * @controllable
         */
        arrowHandler: null
    },

    /**
     * @private
     */
    arrowCls: 'split',

    initialize: function() {
        var me = this,
            el = me.el;

        me.callParent();

        this.arrowElement.addClsOnOver(this.hoveredCls, this.isEnabled, this);
        this.splitInnerElement.addClsOnOver(this.hoveredCls, this.isEnabled, this);
    },

    getTemplate: function() {
        return [{
                reference: 'innerElement',
                cls: Ext.baseCSSPrefix + 'splitBody-el',
                children: [{
                        reference: 'splitInnerElement',
                        cls: Ext.baseCSSPrefix + 'splitInner-el',
                        children: [{
                            reference: 'bodyElement',
                            cls: Ext.baseCSSPrefix + 'body-el',
                            children: [{
                                cls: Ext.baseCSSPrefix + 'icon-el ' + Ext.baseCSSPrefix + 'font-icon',
                                reference: 'iconElement'
                            }, {
                                reference: 'textElement',
                                cls: Ext.baseCSSPrefix + 'text-el'
                            }]
                        }, this.getButtonTemplate()]
                    },
                    {
                        reference: 'arrowElement',
                        cls: Ext.baseCSSPrefix + 'splitArrow-el',
                        children: [{
                            reference: 'splitArrowElement',
                            cls: Ext.baseCSSPrefix + 'arrow-el ' + Ext.baseCSSPrefix + 'font-icon'
                        }, this.getArrowButtonTemplate()]
                    }
                ]
            }
        ];
    },

    getArrowButtonTemplate: function() {
        return {
            tag: 'button',
            reference: 'splitArrowCoverElement',
            cls: Ext.baseCSSPrefix + 'button-el',
            onfocus: 'return Ext.doEv(this, event);',
            onblur: 'return Ext.doEv(this, event);'
        };
    },

    /**
     * @private
     */
    doTap: function(me, e) {
        var arrowEl = this.splitArrowCoverElement,
        arrowKeydown = (e.type === 'keydown' || e.type === 'click') && (e.target === arrowEl.dom);

        // this is done so if you hide the button in the handler, the tap event will not fire
        // on the new element where the button was.
        if (e && e.preventDefault && me.preventDefaultAction) {
            e.preventDefault();
        }

        if (!me.getDisabled()) {
            if (arrowKeydown) {
                me.toggleMenu(e, me.getMenu());
                me.fireEvent("arrowclick", me, e);
                if (me.getArrowHandler()) {
                    Ext.callback(me.getArrowHandler(), me.getScope(), [me, e], 0, me);
                }
            } else {
                if (me.getMenu().isVisible()) {
                    me.hideMenu(e, me.getMenu());
                }
                Ext.callback(me.getHandler(), me.getScope(), [me, e], 0, me);
            }
        }
    },

    onDownKey: function(e) {
        var arrowEl = this.splitArrowCoverElement;
        if (e.target === arrowEl.dom) {
           this.callParent([e]);
        }
    },

    updatePressed: function(pressed) {
        this.callParent([pressed]);
        this.arrowElement.toggleCls(this.pressedCls, pressed);
    },

    findEventTarget: function(e) {
        return e.target === this.buttonElement.dom ? this.splitInnerElement : this.arrowElement;
    },

    shouldRipple: function(e) {
        var arrowEl = this.splitArrowCoverElement,
            ripple = (arrowEl && e.target === arrowEl.dom) ? this.getArrowRipple() : this.getSplitRipple();

        this.setRipple(ripple);
        return this.callParent([e]);
    },

    enableFocusable: function() {
        this.splitArrowCoverElement.dom.disabled = false;

        this.callParent();
    },

    disableFocusable: function() {
        this.callParent();

        this.splitArrowCoverElement.dom.disabled = true;
    },

    privates: {
        onButtonFocus: function(e) {
            this.splitInnerElement.addCls(this.focusCls);
        },

        onButtonBlur: function(e) {
            this.splitInnerElement.removeCls(this.focusCls);
        },

        onArrowFocus: function(e) {
            this.arrowElement.addCls(this.focusCls);
        },

        onArrowBlur: function(e) {
            this.arrowElement.removeCls(this.focusCls);
        },

        handleFocusEvent: function(e) {
            var arrowEl = this.splitArrowCoverElement;
            this.callParent([e]);
            if (e.target === arrowEl.dom) {
                this.onArrowFocus([e]);
            } else if (e.target === this.buttonElement.dom) {
                this.onButtonFocus([e]);
            }
        },

        handleBlurEvent: function(e) {
            var arrowEl = this.splitArrowCoverElement;
            this.callParent([e]);
            if (e.target === arrowEl.dom) {
                this.onArrowBlur([e]);
            } else if (e.target === this.buttonElement.dom) {
                this.onButtonBlur([e]);
            }
        },
    }
});
