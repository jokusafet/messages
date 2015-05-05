<?php

class Sambolek_Messages_Block_Echo extends Mage_Core_Block_Messages
{
    protected $_usedStorageTypes = array(
        'core/session',
        'customer/session',
        'catalog/session',
        'checkout/session',
        'tag/session'
    );    
    
    protected function _toHtml()
    {
        $html = '';
        
        if($this->getMessagesBlock()->getGroupedHtml() || $this->getGroupedHtml())
        {
            $html .= '<div id="sambolek_messages" style="display: none">';
            $html .= $this->getMessagesBlock()->getMessageCollection()->count() ? $this->getMessagesBlock()->getGroupedHtml() : $this->getGroupedHtml();
            $html .= '<a href="javascript:void(0)" id="sambolek_messages_close" style="display: none" title="' . $this->__("Close Message") . '">&times;</a>';
            $html .= '</div>';

            $html .= "<script type=\"text/javascript\">
                    //<![CDATA[
                        Event.observe('sambolek_messages_close', 'click', function() {
                            Effect.SlideUp('sambolek_messages', { duration: 0.4, delay: 0.3 });
                            Effect.Fade('sambolek_messages_close', { duration: 0.2 });
                        });
                        Event.observe(document, 'dom:loaded', function() {
                            Effect.SlideDown('sambolek_messages', { duration: 0.4, delay: 0.3 });
                            Effect.Appear('sambolek_messages_close', { duration: 0.2, delay: 1 });
                        });
                    //]]>
                    </script>";

            $this->getMessagesBlock()->getMessageCollection()->clear();
        }
        
        return $html;
    }
}