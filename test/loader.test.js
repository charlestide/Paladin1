
import Loader from "../resources/assets/js/modules/loader";
import Vue from "vue";
import store from "./store";

let asert = require('assert');

describe('Loader Test',() => {

    let vue = new Vue({store}),
        loader = new Loader(vue);

    it('should load', function () {
        loader.load('app');
    });
});