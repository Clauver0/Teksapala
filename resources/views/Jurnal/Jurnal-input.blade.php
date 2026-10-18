<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Jurnal</title>
     
      @vite(['public/css/menubar.css', 'resources/js/app.js'])
      @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body>
     <div class="jurnal-hero">
          @include('components.menubar')
        <img src="/icons/jurnals-icon.jpeg" alt="Jurnal" class="jurnal-img"> 
      </div>
      <div  class="card">
      <div class="card-header">Input Jurnal</div>
         <div class="card-body">
          
            <div class="card-Jurnal-input">
                 
            </div>
              
            
       </div>
    </div>
</body>
</html>