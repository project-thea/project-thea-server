<template>
  <svg
    v-if="name === 'apple'"
    xmlns="http://www.w3.org/2000/svg"
    width="100"
    height="100"
    viewBox="0 0 100 100"
  ><g fill-rule="nonzero"><path d="M46.173 19.967C49.927-1.838 19.797-.233 14.538.21c-.429.035-.648.4-.483.8 2.004 4.825 14.168 31.66 32.118 18.957zm13.18 1.636c1.269-.891 1.35-1.614.047-2.453l-2.657-1.71c-.94-.607-1.685-.606-2.532.129-5.094 4.42-7.336 9.18-8.211 15.24 1.597.682 3.55.79 5.265.328 1.298-4.283 3.64-8.412 8.088-11.534z" /><path d="M88.588 67.75c9.65-27.532-13.697-45.537-35.453-32.322-1.84 1.118-4.601 1.118-6.441 0-21.757-13.215-45.105 4.79-35.454 32.321 5.302 15.123 17.06 39.95 37.295 29.995.772-.38 1.986-.38 2.758 0 20.235 9.955 31.991-14.872 37.295-29.995z" /></g></svg>
  <svg
    v-else-if="name === 'book'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  ><path d="M6 4H5a1 1 0 1 1 0-2h11V1a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V5a1 1 0 0 0-1-1h-7v8l-2-2-2 2V4z" /></svg>
  <svg v-else-if="name === 'restore'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 64 64"
    ><circle data-name="layer2" cx="33" cy="32" r="30" fill="none" stroke="#202020" stroke-miterlimit="10"
    stroke-width="2" stroke-linejoin="round" stroke-linecap="round">
    </circle><path d="M32.998 49.998v-35M44 28L33 15 22 28" stroke="#202020" stroke-miterlimit="10"
      stroke-width="2" stroke-linejoin="round"
      stroke-linecap="round" />
  </svg>
  <svg v-else-if="name === 'add-test'"
    xmlns="http://www.w3.org/2000/svg"
    width="24" height="24" viewBox="0 0 24 24"
    fill="none" stroke="#000000" stroke-width="2"
    stroke-linecap="round" stroke-linejoin="round">
    <circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line>
    <line x1="8" y1="12" x2="16" y2="12"></line>
  </svg>
  <svg
    v-else-if="name === 'cheveron-down'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  ><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>

  <svg v-else-if="name === 'preview'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 64 64">
    <path
    d="M32 14.5C14.8 14.5 2.5 32 2.5 32S14.8 49.5 32 49.5 61.5 32 61.5 32 49.2 14.5 32 14.5z"
    fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="round"
    stroke-linecap="round"></path>
    <circle data-name="layer1" cx="32" cy="31.5" r="10" fill="none"
    stroke="#202020" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="round"
    stroke-linecap="round"></circle>
    <path data-name="layer1" d="M28.5 29.5a4 4 0 0 0 3.5 6" fill="none"
    stroke="#202020" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="round"
    stroke-linecap="round"></path></svg>

  <svg
    v-else-if="name === 'cheveron-right'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  ><polygon points="12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707" /></svg>
  <svg
    v-else-if="name === 'dashboard'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  ><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z" /></svg>
  <svg
    v-else-if="name === 'location'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  ><path d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" /></svg>
  <svg
    v-else-if="name === 'office'"
    xmlns="http://www.w3.org/2000/svg"
    width="100"
    height="100"
    viewBox="0 0 100 100"
  ><path
    fill-rule="evenodd"
    d="M7 0h86v100H57.108V88.418H42.892V100H7V0zm9 64h11v15H16V64zm57 0h11v15H73V64zm-19 0h11v15H54V64zm-19 0h11v15H35V64zM16 37h11v15H16V37zm57 0h11v15H73V37zm-19 0h11v15H54V37zm-19 0h11v15H35V37zM16 11h11v15H16V11zm57 0h11v15H73V11zm-19 0h11v15H54V11zm-19 0h11v15H35V11z"
  /></svg>
  <svg
    v-else-if="name === 'printer'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  ><path d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" /></svg>
  <svg
    v-else-if="name === 'shopping-cart'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  ><path d="M4 2h16l-3 9H4a1 1 0 1 0 0 2h13v2H4a3 3 0 0 1 0-6h.33L3 5 2 2H0V0h3a1 1 0 0 1 1 1v1zm1 18a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm10 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" /></svg>
  <svg
    v-else-if="name === 'store-front'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  ><path d="M18 9.87V20H2V9.87a4.25 4.25 0 0 0 3-.38V14h10V9.5a4.26 4.26 0 0 0 3 .37zM3 0h4l-.67 6.03A3.43 3.43 0 0 1 3 9C1.34 9 .42 7.73.95 6.15L3 0zm5 0h4l.7 6.3c.17 1.5-.91 2.7-2.42 2.7h-.56A2.38 2.38 0 0 1 7.3 6.3L8 0zm5 0h4l2.05 6.15C19.58 7.73 18.65 9 17 9a3.42 3.42 0 0 1-3.33-2.97L13 0z" /></svg>
  <svg
    v-else-if="name === 'trash'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  ><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z" /></svg>
  <svg
    v-else-if="name === 'users'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  ><path d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z" /></svg>
	<svg
	v-else-if="name === 'gps-route'"
	version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 496.84 496.84" style="enable-background:new 0 0 496.84 496.84;" xml:space="preserve">
	<g>
	<path d="M398.248,196.799c0.016,0,0.029-0.01,0.045-0.01c-0.016,0-0.045,0.01-0.08,0.01H398.248z"/>
	<path d="M375.394,184.199c-4.127-6.521-8.348-13.473-12.59-20.543H65.918c-16.167,0-29.32,13.154-29.32,29.322v35.213
		c0,16.166,13.153,29.316,29.32,29.316h173.558c1.686,0,3.059,1.375,3.059,3.057v48.58c0,16.84,13.708,30.539,30.538,30.539h78.5
		c3.594,0,6.522,2.918,6.522,6.512v110.988c0,3.594-2.929,6.516-6.522,6.516H183.016c-5.549,9.49-11.197,18.805-16.651,27.43
		c-1.378,2.174-3.074,4.053-4.935,5.711h190.143c21.866,0,39.665-17.793,39.665-39.656V346.195
		c0-21.863-17.799-39.654-39.665-39.654h-75.895v-45.977c0-19.961-16.247-36.199-36.201-36.199H69.74v-27.566h328.473
		C388.877,196.773,380.35,192.055,375.394,184.199z"/>
	<path d="M143.516,306.938c-34.226,0-61.994,27.754-61.994,61.994c0,26.103,36.037,86.254,53.156,113.359
		c1.912,3.025,5.26,4.863,8.838,4.863c3.592,0,6.926-1.844,8.837-4.871c17.136-27.115,53.157-87.248,53.157-113.352
		C205.51,334.691,177.756,306.938,143.516,306.938z M143.516,399.533c-15.359,0-27.804-12.451-27.804-27.811
		c0-15.363,12.444-27.809,27.804-27.809c15.358,0,27.803,12.445,27.803,27.809C171.318,387.082,158.874,399.533,143.516,399.533z"/>
	<path d="M398.248,0c-34.23,0-61.999,27.754-61.999,61.994c0,26.106,36.022,86.238,53.162,113.354
		c1.911,3.033,5.244,4.869,8.837,4.879c3.572,0,6.926-1.846,8.832-4.873c17.125-27.104,53.162-87.254,53.162-113.359
		C460.242,27.754,432.488,0,398.248,0z M398.248,92.598c-15.359,0-27.804-12.453-27.804-27.811
		c0-15.365,12.444-27.809,27.804-27.809c15.354,0,27.799,12.443,27.799,27.809C426.047,80.145,413.602,92.598,398.248,92.598z"/>
</g>
</svg>


</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true,
    },
  },
}
</script>
