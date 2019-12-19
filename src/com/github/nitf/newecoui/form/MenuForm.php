<?php

namespace com\github\nitf\newecoui\form;

use com\github\nitf\newecoui\infrastructure\MessageRepository;
use pocketmine\form\Form;
use pocketmine\Player;

class MenuForm implements Form
{
    const InfoButton = 0;
    const PayButton = 1;
    const SearchButton = 2;

    public function handleResponse(Player $player, $data): void
    {
        if ($data === null) {
            return;
        }

        switch ($data) {
            case self::InfoButton:
                $onBuild = function (Player $player): Form{
                    return new InfoForm($player);
                };
                new BuildForm($player, $onBuild);
                return;

            case self::PayButton:
                $onBuild = function (Player $player): Form{
                    return new PayForm();
                };
                new BuildForm($player, $onBuild);
                return;

            case self::SearchButton:
                $onBuild = function (Player $player): Form{
                    return null;
                };
                new BuildForm($player, $onBuild);
                return;

            default:
                return;
        }
    }

    public function jsonSerialize()
    {
        $messageRepository = new MessageRepository();
        return [
            "type" => "form",
            "title" => "SimpleForm",
            "content" => "Select button.",
            "buttons" => [
                [
                    "text" => $messageRepository->getMessage("menu.info_button"),
                ],
                [
                    "text" => $messageRepository->getMessage("menu.pay_button"),
                ],
                [
                    "text" => $messageRepository->getMessage("menu.search_button"),
                ]
            ]
        ];
    }
}