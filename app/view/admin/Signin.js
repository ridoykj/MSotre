/*
 * File: app/view/admin/Signin.js
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

Ext.define('MStore.view.admin.Signin', {
    extend: 'Ext.window.Window',
    alias: 'widget.admin.signin',

    requires: [
        'MStore.view.admin.SigninViewModel',
        'Ext.panel.Panel',
        'Ext.Img',
        'Ext.form.field.Text',
        'Ext.form.Label',
        'Ext.button.Button'
    ],

    viewModel: {
        type: 'admin.signin'
    },
    autoShow: true,
    height: 430,
    id: 'in_FSignin',
    width: 383,
    title: 'Sign In',

    layout: {
        type: 'vbox',
        align: 'stretch'
    },
    items: [
        {
            xtype: 'panel',
            flex: 0.27,
            height: 128,
            layout: 'center',
            items: [
                {
                    xtype: 'image',
                    height: 82,
                    width: 74,
                    src: 'ico/login.png'
                }
            ]
        },
        {
            xtype: 'panel',
            flex: 0.6,
            layout: 'absolute',
            items: [
                {
                    xtype: 'textfield',
                    x: 40,
                    y: 70,
                    id: 'in_email',
                    width: 280,
                    fieldLabel: 'Email',
                    inputType: 'email'
                },
                {
                    xtype: 'textfield',
                    x: 40,
                    y: 120,
                    id: 'in_pass',
                    width: 280,
                    fieldLabel: 'Password',
                    inputType: 'password'
                },
                {
                    xtype: 'label',
                    x: 140,
                    y: 170,
                    id: 'in_status',
                    text: 'Status:'
                }
            ]
        }
    ],
    dockedItems: [
        {
            xtype: 'panel',
            flex: 0.15,
            dock: 'bottom',
            height: 40,
            width: 379,
            layout: {
                type: 'hbox',
                align: 'stretch'
            },
            items: [
                {
                    xtype: 'button',
                    id: 'in_BSignUp',
                    width: 180,
                    text: 'Sign Up'
                },
                {
                    xtype: 'button',
                    id: 'in_BSignIn',
                    width: 200,
                    text: 'Sign In'
                }
            ]
        }
    ]

});