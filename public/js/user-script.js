/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery.fn.extend({
    zigzag: function () {
        var text = $(this).text();
        var zigzagText = '';
        var toggle = true; //lower/uppper toggle
        $.each(text, function (i, nome) {
            zigzagText += (toggle) ? nome.toUpperCase() : nome.toLowerCase();
            toggle = (toggle) ? false : true;
        });
        return zigzagText;
    }
});

//console.log($('#tagline').zigzag());
//output: #1 jQuErY BlOg fOr yOuR DaIlY NeWs, PlUgInS, tUtS/TiPs & cOdE SnIpPeTs.

//chained example
//
//console.log($('#tagline').zigzag().toLowerCase());
//
//output: #1 jquery blog for your daily news, plugins, tuts/tips & code snippets.