/*
 * File: app/view/admin/SigninViewController.js
 *
 * This file was generated by Sencha Architect version 4.2.6.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Ext JS 6.5.x Classic library, under independent license.
 * License of Sencha Architect does not include license for Ext JS 6.5.x Classic. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('MStore.view.admin.SigninViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.admin.signin',

    onIn_BSignUpClick: function(button, e, eOpts) {
        var singup = Ext.create('MStore.view.admin.SignupWin',{});
        singup.show();
        Ext.getCmp('in_FSignin').destroy();
    },

    onIn_BSignInClick: function(button, e, eOpts) {
        var email = Ext.getCmp('in_email').value;
        var password = Ext.getCmp('in_pass').value;
        console.log(email + password);


        var singup = Ext.create('MStore.view.profile.userProfile',{});
        singup.show();
        Ext.getCmp('in_FSignin').destroy();
    }

});
