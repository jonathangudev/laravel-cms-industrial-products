!function(e){var t={};function n(r){if(t[r])return t[r].exports;var i=t[r]={i:r,l:!1,exports:{}};return e[r].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:r})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=2)}({2:function(e,t,n){e.exports=n("w74b")},w74b:function(e,t){for(var n=document.getElementsByClassName("js-category-menu-icon"),r=0;r<n.length;r++){if(n[r].parentElement.parentElement.classList.contains("is-active")){var i=n[r].parentElement.nextElementSibling;i.style.height=i.scrollHeight+"px"}n[r].addEventListener("click",function(e){var t=e.currentTarget.parentElement.parentElement,n=e.currentTarget.parentElement.nextElementSibling;t.classList.contains("is-open")?(t.classList.remove("is-open"),n.style.height=0):(t.classList.add("is-open"),n.style.height=n.scrollHeight+"px")})}}});