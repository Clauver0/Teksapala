<style>
    #helpModal {
        display: none; /* diubah jadi 'flex' oleh JavaScript saat dibuka */
        position: fixed;
        inset: 0;
        z-index: 99999;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        justify-content: center;
        align-items: center;
        padding: 1rem;
    }

    #helpModal .help-modal-box {
        position: relative;
        width: 100%;
        max-width: 1100px;
        height: 90vh;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
    }

    #helpModal .help-modal-close {
        position: absolute;
        top: 0.5rem;
        right: 0.9rem;
        z-index: 2;
        background: none;
        border: none;
        font-size: 2rem;
        line-height: 1;
        color: #ffffff;
        cursor: pointer;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.6);
    }

    #helpModal .help-modal-frame {
        display: block;
        width: 100%;
        height: 100%;
        border: 0;
    }
</style>

<div id="helpModal">
    <div class="help-modal-box">

        <button type="button" class="help-modal-close" onclick="closeHelpModal()">
            &times;
        </button>

       <iframe
    src="{{ route('help', ['modal' => 1]) }}"
    class="help-modal-frame"
    title="Bantuan Pembayaran">
</iframe>

    </div>
</div>