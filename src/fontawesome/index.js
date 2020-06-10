import Vue from 'vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faEllipsisH, faCrown, faCommentDots, faDice, faHome, faComments, faListAlt, faScroll, faDonate, faClipboardList, faGamepad, faCogs } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faEllipsisH, faCrown, faCommentDots, faDice, faHome, faComments, faListAlt, faScroll, faDonate, faClipboardList, faGamepad, faCogs);

Vue.component('fa-icon', FontAwesomeIcon);
