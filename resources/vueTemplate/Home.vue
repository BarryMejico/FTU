<template>
    <div>
        <h1>Welcome to Finance Training Unit Portal</h1>
    </div>
<div class="container">

<div class="aboutus" id="mission">
<div class="mission">
    <h2>Mission</h2>
    <p>To provide high standard and responsive Budget, Fiscal and Finance Education and Training to develop a competent, excellent and highly-skilled BFF professionals for the Philippine Navy.</p> 
</div>
</div>

<div class="aboutus" id="vision">
<div class="vision">
    <h2>Vision</h2>
    <p>By 2028, to be a competent and capable Budget, Fiscal and Finance (BFF) Education and Training Administrator that produces motivated, excellent and highly-skilled BFF Professionals for the Philippine Navy.</p> 
</div> 
</div>   

</div>

</template>

<style>
.container {
      margin-top: 50px;
      margin-bottom: 50px;
      padding: 2rem;
      max-width: auto;
      margin-left: 0;
      margin-right: 5px;
      display: flex;
      justify-content: center   ;
      align-items: flex-start;
}  


.aboutus h2 {
  color: #333;
  margin-bottom: 10px;
}
.aboutus {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      padding: 1rem 1rem;
      text-align: center;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .aboutus::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, rgb(201, 201, 201), #04AA6D);
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .aboutus:hover::before {
      transform: scaleX(1);
    }

    .aboutus:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }
</style>