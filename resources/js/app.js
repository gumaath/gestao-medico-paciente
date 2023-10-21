import "./bootstrap";
import "../css/app.css";
import "@protonemedia/laravel-splade/dist/style.css";
import Alpine from 'alpinejs';
import 'jquery-mask-plugin';
import select2 from 'select2';
import "/node_modules/select2/dist/css/select2.css";
select2($);

window.Alpine = Alpine;

Alpine.start();


import { createApp } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";

const el = document.getElementById("app");

createApp({
    render: renderSpladeApp({ el })
})
    .use(SpladePlugin, {
        "max_keep_alive": 10,
        "transform_anchors": false,
        "progress_bar": true
    })
    .mount(el);
