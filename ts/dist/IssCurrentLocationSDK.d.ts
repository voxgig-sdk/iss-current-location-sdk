import { IssLocationEntity } from './entity/IssLocationEntity';
export type * from './IssCurrentLocationTypes';
import { inspect } from 'node:util';
import type { Context, Feature } from './types';
import { config } from './Config';
import { IssCurrentLocationEntityBase } from './IssCurrentLocationEntityBase';
import { Utility } from './utility/Utility';
import { BaseFeature } from './feature/base/BaseFeature';
declare const stdutil: Utility;
declare class IssCurrentLocationSDK {
    _mode: string;
    _options: any;
    _utility: Utility;
    _features: Feature[];
    _rootctx: Context;
    constructor(options?: any);
    options(): any;
    utility(): any;
    prepare(fetchargs?: any): Promise<any>;
    direct(fetchargs?: any): Promise<Error | {
        ok: boolean;
        status: number;
        headers: any;
        data: any;
        err?: undefined;
    } | {
        ok: boolean;
        err: any;
        status?: undefined;
        headers?: undefined;
        data?: undefined;
    }>;
    _rawRequest(fetchargs?: any): Promise<Error | {
        ok: boolean;
        status: number;
        headers: any;
        data: any;
        err?: undefined;
    } | {
        ok: boolean;
        err: any;
        status?: undefined;
        headers?: undefined;
        data?: undefined;
    }>;
    graphql(query: string, variables?: any, ctrl?: any): Promise<any>;
    IssLocation(entopts?: Record<string, any>): IssLocationEntity;
    static test(testoptsarg?: any, sdkoptsarg?: any): IssCurrentLocationSDK;
    tester(testopts?: any, sdkopts?: any): IssCurrentLocationSDK;
    toJSON(): {
        name: string;
    };
    toString(): string;
    [inspect.custom](): string;
}
declare const SDK: typeof IssCurrentLocationSDK;
export { stdutil, config, BaseFeature, IssCurrentLocationEntityBase, IssCurrentLocationSDK, SDK, };
