<template>
<footer style="font-style:
 italic; 
 color: #e6f2fb;  
  text-align:center;
   height: 40px; 
   padding-bottom: 10PX;
   background: #071430;">
    <p style="margin-bottom:30PX; font-size:0.9rem">FTU 2028: Competent and Capable Budget, Fiscal and Finance Education and Training Administrator</p>
</footer>
</template>

<script>
export default {
    name: 'MyFooter'
}
</script>

<style>
footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #071430;
 transition: border-radius 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.shadow {
 box-shadow: inset 0 -3em 3em rgba(0,0,0,0.1),
             0 0  0 2px rgb(190, 190, 190),
             0.3em 0.3em 1em rgba(0,0,0,0.3);
}
</style>