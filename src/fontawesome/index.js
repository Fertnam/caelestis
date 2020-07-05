import Vue from 'vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faDotCircle, faChevronCircleLeft, faChevronCircleRight, faCalendarAlt, faSearch, faEllipsisH, faCrown, faCommentDots, faDice, faHome, faComments, faListAlt, faScroll, faDonate, faClipboardList, faGamepad, faCogs } from '@fortawesome/free-solid-svg-icons';
import { faDotCircle as faDotCircleReg } from '@fortawesome/free-regular-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faDotCircleReg, faDotCircle, faChevronCircleLeft, faChevronCircleRight, faCalendarAlt, faSearch, faEllipsisH, faCrown, faCommentDots, faDice, faHome, faComments, faListAlt, faScroll, faDonate, faClipboardList, faGamepad, faCogs);

Vue.component('fa-icon', FontAwesomeIcon);
