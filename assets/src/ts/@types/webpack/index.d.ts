import { Configuration } from 'webpack';

declare global {
  type WebpackConfiguration = Configuration;
}
