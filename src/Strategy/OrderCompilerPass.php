<?php


namespace App\Strategy;


use App\Entity\Interfaces\OrderStrategyInterface;
use App\Entity\Order;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class OrderCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $resolverService = $container->findDefinition(Order::class);
        $strategyServices = array_keys($container->findTaggedServiceIds(OrderStrategyInterface::SERVICE_TAG));
        foreach ($strategyServices as $strategyService) {
            $resolverService->addMethodCall('addStrategy', [new Reference($strategyService)]);
        }
    }
}