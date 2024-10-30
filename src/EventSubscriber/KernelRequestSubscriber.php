<?php

/*
 * This file is part of Contao ThemeManager Core.
 *
 * (c) https://www.oveleon.de/
 */

namespace ContaoThemeManager\Accessibility\EventSubscriber;

use Contao\ArrayUtil;
use Contao\BackendUser;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class KernelRequestSubscriber implements EventSubscriberInterface
{
    public function __construct(
        protected readonly ScopeMatcher $scopeMatcher,
        protected readonly TranslatorInterface $translator,
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => 'onKernelRequest'];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if ($this->scopeMatcher->isFrontendMainRequest($event))
        {
            $GLOBALS['TL_HEAD'][] = '<script>const navAriaLabels={' .
                "menu_main:'"     . $this->translator->trans('ctm.aria.menu.main', [], 'aria') . "'," .
                "menu_sub:'"      . $this->translator->trans('ctm.aria.menu.sub', [], 'aria') . "'," .
                "menu_toggle:'"   . $this->translator->trans('ctm.aria.menu.toggle', [], 'aria') . "'," .
                "menu_expand:'"   . $this->translator->trans('ctm.aria.menu.expand', [], 'aria') . "'," .
                "menu_collapse:'" . $this->translator->trans('ctm.aria.menu.collapse', [], 'aria') . "'," .
                "menu_back:'"     . $this->translator->trans('ctm.aria.menu.back', [], 'aria') . "'," .
                "menu_to:'"       . $this->translator->trans('ctm.aria.menu.to_menu', [], 'aria') . "'," .
                "scroll_to_top:'" . $this->translator->trans('ctm.aria.scroll_to_top', [], 'aria') . "'" .
            '}</script>';
        }
    }
}
