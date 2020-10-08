const $ = require("jquery");
const M = require("materialize-css");
$(() => {
    M.textareaAutoResize($("#description"));
    M.Tabs.getInstance();
});
