"use strict";

var conn = new WebSocket('ws://localhost:9090');
conn.onopen = function(e) {
    console.log("Connection established!");

};

conn.onmessage = function(e) {
    console.log(e.data);

    var $el = $('li.messages-menu ul.menu li:first').clone();
    $el.find('p').text(e.data);
    $el.find('h4').text('Websocket user');
    $el.prependTo('li.messages-menu ul.menu');

    var cnt = $('li.messages-menu ul.menu li').length;
    $('li.messages-menu span.label-success').text(cnt);
    $('li.messages-menu li.header').text('You have ' + cnt + ' messages');
};