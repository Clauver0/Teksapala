<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jurnal</title>
     @vite(['public/css/menubar.css', 'resources/js/app.js'])
      @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body>
    
       <div class="jurnal-hero">
          @include('components.menubar')
        <img src="/icons/jurnals-icon.jpeg" alt="Jurnal" class="jurnal-img"> 
       </div>
    
    <div  class="card">
      <div class="card-header">Edit Jurnal</div>
         <div class="card-body">
          
            <div class="card-input">
                 <a href="/input-jurnal" class="btn btn-primary">Input Jurnal</a>
            </div>
            &nbsp;&nbsp;      
            <div class="card-input1">
                <a href="/kelola-jurnal" class="btn btn-secondary">Kelola Jurnal</a>
            </div>
</body>
<script>
        const card = document.getElementById('jurnalCard');
        const btn = document.getElementById('btnExpand');

        btn.addEventListener('click', () => {
            card.classList.toggle('expanded');
            const isBig = card.classList.contains('expanded');
            btn.textContent = isBig ? '🗗' : '⛶';
            btn.title = isBig ? 'Perkecil' : 'Perbesar';
        });
    </script>
</html>