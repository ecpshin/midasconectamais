/*! DataTables styling wrapper for Buttons
 * © SpryMedia Ltd - datatables.net/license
 */

(function( factory ){
    if ( typeof define === 'function' && define.amd ) {
        // AMD
        define( ['public/plugins/jquery/jquery.js', 'datatables.net-dt', 'datatables.net-buttons'], function ($ ) {
            return factory( $, window, document );
        } );
    }
    else if ( typeof exports === 'object' ) {
        // CommonJS
        var jq = require('public/plugins/jquery/jquery.js');
        var cjsRequires = function (root, $) {
            if ( ! $.fn.dataTable ) {
                require('datatables.net-dt')(root, $);
            }

            if ( ! $.fn.dataTable.Buttons ) {
                require('datatables.net-buttons')(root, $);
            }
        };

        if (typeof window === 'undefined') {
            module.exports = function (root, $) {
                if ( ! root ) {
                    // CommonJS environments without a window global must pass a
                    // root. This will give an error otherwise
                    root = window;
                }

                if ( ! $ ) {
                    $ = jq( root );
                }

                cjsRequires( root, $ );
                return factory( $, root, root.document );
            };
        }
        else {
            cjsRequires( window, jq );
            module.exports = factory( jq, window, window.document );
        }
    }
    else {
        // Browser
        factory( jQuery, window, document );
    }
}(function( $, window, document ) {
    'use strict';
    var DataTable = $.fn.dataTable;




    return DataTable;
}));