// Global CDN, use source.zoom.us:
window.addEventListener('DOMContentLoaded', function(event) {
    console.log('DOM fully loaded and parsed');
    ZoomMtg.setZoomJSLib('https://source.zoom.us/2.15.2/lib', '/av')
// loads dependent assets
    ZoomMtg.preLoadWasm()
    ZoomMtg.prepareWebSDK()
// loads language files, also passes any error messages to the ui
    ZoomMtg.i18n.load('en-US')
    ZoomMtg.i18n.reload('en-US')
});

