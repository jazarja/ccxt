# -*- coding: utf-8 -*-

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

from ccxt.async_support.huobi import huobi


class huobipro(huobi):

    def describe(self):
        # self is an alias for backward-compatibility
        # to be removed soon
        return self.deep_extend(super(huobipro, self).describe(), {
            'id': 'huobipro',
            'alias': True,
            'name': 'Huobi Pro',
        })
